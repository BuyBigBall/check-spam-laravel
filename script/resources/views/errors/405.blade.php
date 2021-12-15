@extends('layouts.errors')

@section('title', __('Method Not Allowed'))
@section('code', '405')
@section('message', __('Method Not Allowed'))
@section('message2', __('Something is broken. Please let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.'))