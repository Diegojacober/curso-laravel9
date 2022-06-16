@extends('layouts.app')
@section('title','Criar novo usuário')

@section('content')
    <h1>Novo Usuário</h1>

   @include('includes.validations-form')

    <form enctype="multipart/form-data" action="{{route('users.store')}}" method="post">
        @csrf
        @include('users.partials.form')
    </form>
@endsection