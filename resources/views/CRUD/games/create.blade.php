
@extends('layouts.app')

@section('content')
    <div class="container">

        <br>
        <h1>Create Game </h1>
        @include('CRUD/forms/form', ['form'=>$form])
    </div>
@endsection
@section('scripts')
{{--    @if(Route::currentRouteName() == 'matches/create')--}}
        <script src="{{ asset('js/ajax-form-submission.js') }}"></script>
{{--    @endif--}}
@endsection
