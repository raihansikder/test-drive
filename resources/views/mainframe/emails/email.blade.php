@extends('mainframe.layouts.email.template')

<?php
/*
|--------------------------------------------------------------------------
| Directly load the $email->html in this blade
|--------------------------------------------------------------------------
|
*/
/**
 * @var \App\Email $email
 */
?>

@section('content')
    {!! $email->html !!}
@endsection
