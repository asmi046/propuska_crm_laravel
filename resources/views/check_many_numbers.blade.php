@extends('layouts.all_interface')

@php
    $title = "Массовая проверка номеров";
    $description = "Массовая проверка номеров";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="mass_n_check" class="table_section">
        <h1>{{ $title }}</h1>
        <mass-number-check></mass-number-check>
    </section>
@endsection

