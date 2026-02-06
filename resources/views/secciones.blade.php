@extends('layouts.principal')
@section('header')  
  <link href="{{ asset('assets/css/listing.css')}}" rel="stylesheet">
@endsection
@section('titulo' , $titulo)
@section('content')
  <div class="container">
    <div class="row">
      <div class="col py-4">
        {!! nl2br($contenido) !!}
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="{{ asset('assets/js/sticky_sidebar.min.js')}}"></script>
	<script src="{{ asset('assets/js/specific_listing.js')}}"></script>
@endsection