@extends('layouts.app')
@section('title','Editar usuário')

@section('content')
    <h1>Editar o Usuário {{$user->name}}</h1>

    @include('includes.validations-form')

    <form enctype="multipart/form-data" action="{{route('users.update',['id' => $user->id])}}" method="post">
        @method('PUT')
        @include('users.partials.form')
    </form>
@endsection