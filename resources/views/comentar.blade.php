@extends('layouts.principal')
@section('header')
<link href="{{ asset('assets/css/leave_review.css')}}" rel="stylesheet">
@endsection
@section('content')
    @livewire('comentar-component' , [ 'productoId' => Hashid::decode($productoId)])
@endsection