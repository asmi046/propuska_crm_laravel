@extends('layouts.all_interface')

@php
    $title = "Оповещение о Штрафах";
    $description = "Оповещение о Штрафах";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="fine_alert_list" class="table_section">
        <h1>{{ $title }}</h1>
        <fine-alert-list></fine-alert-list>
    </section>
@endsection

