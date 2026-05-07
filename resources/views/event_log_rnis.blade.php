@extends('layouts.all_interface')

@php
    $title = 'Лог событий РНИС';
    $description = 'Лог событий РНИС';
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="rnis_event_log" class="table_section">
        <h1>{{ $title }}</h1>
        <rnis-log action="{{ route('rnis_get_event_list') }}"></rnis-log>

    </section>
@endsection
