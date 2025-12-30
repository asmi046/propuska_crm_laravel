@extends('layouts.all_interface')

@php
    $title = 'Антизависание';
    $description = 'Антизависание';
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="stop_spam" class="table_section">
        <h1>{{ $title }}</h1>
        <stop-spam></stop-spam>
    </section>
@endsection
