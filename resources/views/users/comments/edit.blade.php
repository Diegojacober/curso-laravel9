@extends('layouts.app')
@section('title','Editar usuário')

@section('content')
    <h1>Editar comentário de {{$user->name}}</h1>

    @include('includes.validations-form')

    <form action="{{route('comments.update',['id' => $comment->id])}}" method="post">
        @method('PUT')
        @include('users.comments.partials.form')
    </form>
@endsection