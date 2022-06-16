@extends('layouts.app')

@section('title', 'Listagem de Usuários')

@section('content')
    <h1 class="text-2x1 font-semibold leading-tigh py-2">Listagem dos usuários <a href="{{ route('users.create') }}" class
            ="btn btn-primary text-dark">+</a></h1>

    <form action="{{ route('users.index') }}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button type="submit">🔍</button>
    </form>

    <div class="table-responsive">
    <table class="table table-dark table-hover mt-5">
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row"><img style="border-radius: 10%" class="" width="50" height="50" 
                    @if ($user->image == 'images/padrao.png')
                        src="https://ui-avatars.com/api/?name={{$user->name}}&rounded=true&background=random"    
                    @else
                        src="{{url("storage/$user->image")}}"
                    @endif  
                    alt="{{$user->name}}" ></th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a class="btn btn-sm btn-info" href="{{ route('users.show', ['id' => $user->id]) }}">Detalhes</a></td>
                    <td><a class="btn btn-sm btn-success" href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a></td>
                    <td><a class="btn btn-sm btn-light" href="{{ route('comments.index', $user->id) }}">Ver Comentários
                            ({{ $user->comments->count() }})</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <div class="py-4">
        {{ $users->appends([
            'search' => request()->get('search','')
        ])->links() }}
    </div>

@endsection
