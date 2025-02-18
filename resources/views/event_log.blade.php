@extends('layouts.all_interface')

@php
    $title = "Лог событий";
    $description = "Лог событий";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="event_log" class="table_section">
        <h1>{{ $title }}</h1>
        <log-event></log-event>
    </section>
@endsection
