@extends('layouts.app')

@section('title','Listagem dos comentários ')

@section('content')
<h1 class="text-2x1 font-semibold leading-tigh py-2">Comentarios de {{$user->name}} <a href="{{route('comments.create',$user->id)}}" class ="bg-blue">+</a></h1>

<form action="{{route('comments.index',$user->id)}}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button type="submit">🔍</button>
</form>

<div class="table-responsive">
    <table class="table table-dark table-hover mt-5">
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <th scope="row"><img style="border-radius: 10%" class="" width="50" height="50" 
                    @if ($user->image == 'images/padrao.png')
                        src="https://ui-avatars.com/api/?name={{$user->name}}&rounded=true&background=random"    
                    @else
                        src="{{url("storage/$user->image")}}"
                    @endif  
                    alt="{{$user->name}}" ></th>
                    <td>{{$comment->body}} </td>
                    <td>{{$comment->visible}}</td>
                    <td><a class="btn btn-sm btn-success" href="{{route('comments.edit',['id'=>$comment->id,'userid' => $user->id])}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="py-4">
    {{ $comments->appends([
        'search' => request()->get('search','')
    ])->links() }}
</div>

@endsection