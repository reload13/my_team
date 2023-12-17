
@extends('layouts.app')

@section('content')
    <div class="container">

        <br>
        <h1>Create Team </h1>
        @include('CRUD/forms/form', ['form'=>$form])
    </div>
@endsection
