@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>Edit Player {{$data['name']}}</h1>
        @include('CRUD/forms/form', ['data' => $data,'form'=>$form])

    </div>
@endsection
@section('scripts')
    {{--    @if(Route::currentRouteName() == 'matches/create')--}}
    <script src="{{ asset('js/ajax-form-submission.js') }}"></script>
    {{--    @endif--}}
@endsection
