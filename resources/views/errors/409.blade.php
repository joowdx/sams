@extends('errors::minimal')

@section('title', __('Conflict'))
@section('code', '409')
@section('message', __($exception->getMessage() ?:'Conflict'))
