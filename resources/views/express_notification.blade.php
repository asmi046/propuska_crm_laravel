@extends('layouts.all_interface')

@php
    $title = "Эестренное оповещение об ануляции";
    $description = "Эестренное оповещение об ануляции";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="mass_alert_app" class="table_section">
        <h1>{{ $title }}</h1>
        <mass-alert></mass-alert>
    </section>
@endsection

