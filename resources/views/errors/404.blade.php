@extends('errors::minimal')

@section('title', __($exception->getMessage() ?: 'Not Found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Not Found'))
