@extends('layouts.all_interface')

@php
    $title = "База должников";
    $description = "База должников";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>

    </section>
@endsection
