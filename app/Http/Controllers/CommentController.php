<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredUpdatedCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $model;
    protected $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->model = $comment;
        $this->user = $user;
    }
    public function index(Request $request,$userId)
    {
        if(!$user = $this->user->find($userId)){
            return redirect()->back();
        }
        $comments = $user->comments()
                         ->where('body','LIKE',"%$request->search%")
                         ->paginate();
        return view('users.comments.index',compact('user','comments'));
    }

    
    public function create($userId)
    {
        if(!$user = $this->user->find($userId)){
            return redirect()->back();
        }
        return view('users.comments.create',compact('user'));
    }

    public function store(StoredUpdatedCommentRequest $request,$userId)
    {
        if(!$user = $this->user->find($userId)){
            return redirect()->back();
        }
        $user->comments()->create([
            'visible' => isset($request->visible),
            'body' => $request->body
        ]);
        return redirect()->route('comments.index',$user->id);
    }

    
    public function show($id)
    {
        //
    }

    public function edit($userId,$id)
    {
        if(!$comment = $this->model->find($id)){
            return redirect()->back();
        }
        $user = $comment->user;
        return view('users.comments.edit',compact('comment','user'));
    }

    public function update(StoredUpdatedCommentRequest $request, $id)
    {
        if(!$comment = $this->model->find($id)){
            return redirect()->back();
        }

        $comment->update([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);

        return redirect()->route('comments.index',$comment->user_id);
    }


    public function destroy($id)
    {
        //
    }
}
