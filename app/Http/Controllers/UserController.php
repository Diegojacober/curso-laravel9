<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {   
        $search = $request->search;
        $users = $this->model->getUsers(search: $request->get('search',''));
        return view('users.index',['users' => $users]);
    }

    public function show($id)
    {
        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        return view('users.show',compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        

        if($request->image){
           // $data['image'] = $request->image->store('images');
           $extension = $request->file('image')->getClientOriginalExtension();
           $fileName = md5(now());
           $data['image'] = $request->image->storeAs('images',"$fileName.$extension");
        }
        $this->model->create($data);

        return redirect()->route('users.index');
    }

    public function edit($id){
        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        return view('users.edit',compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request,$id){
        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        $data = $request->only(['name','email']);
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        if($request->image){
            if(Storage::exists($user->image)){
                if($user->image != 'images/padrao.png'){
                    Storage::delete($user->image);
                }
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = md5(now());
            $data['image'] = $request->image->storeAs('images',"$fileName.$extension");

         }

        $user->update($data);
        return redirect()->route('users.index');
    }
}
