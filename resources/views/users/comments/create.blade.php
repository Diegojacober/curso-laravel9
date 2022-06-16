@extends('layouts.app')
@section('title','Criar novo comentário')

@section('content')
    <h1>Novo comentário para o usuário {{$user->name}}</h1>

   @include('includes.validations-form')

    <form action="{{route('comments.store',$user->id)}}" method="post">
        @csrf
        @include('users.comments.partials.form')
    </form>
@endsection