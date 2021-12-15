@extends('layouts.errors')

@section('title', __('Internal Server Error'))
@section('code', '500')
@section('message', __('Oops… You just found an error page'))
@section('message2', __('We are sorry but our server encountered an internal error'))

