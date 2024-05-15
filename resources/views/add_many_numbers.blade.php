@extends('layouts.all_interface')

@php
    $title = "Массовое добавление номеров";
    $description = "Массовое добавление номеров";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="mass_add" class="table_section">
        <h1>{{ $title }}</h1>
        <mass-add></mass-add>
    </section>
@endsection

