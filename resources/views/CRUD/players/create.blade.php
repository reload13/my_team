
@extends('layouts.app')

@section('content')
    <div class="container">

        <br>
        <h1>Create Player </h1>
        @include('CRUD/forms/form', ['form'=>$form])
    </div>
@endsection
