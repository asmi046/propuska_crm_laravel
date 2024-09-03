@extends('layouts.all_interface')

@php
    $title = "Обновление данных по номеру пропуска";
    $description = "Обновление данных по номеру пропуска";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section" id="update_by_number">
        <h1>{{ $title }}</h1>
        <update-by-number></update-by-number>
    </section>
@endsection

