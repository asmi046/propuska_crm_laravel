@extends('layouts.all_interface')

@php
    $title = "Оповещение о ТО";
    $description = "Оповещение о ТО";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="to_alert_list" class="table_section">
        <h1>{{ $title }}</h1>
        <to-alert-list></to-alert-list>
    </section>
@endsection

