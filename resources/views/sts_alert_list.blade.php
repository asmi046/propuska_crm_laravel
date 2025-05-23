@extends('layouts.all_interface')

@php
    $title = "Оповещение о смены СТС";
    $description = "Оповещение о смены СТС";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="sts_alert_list" class="table_section">
        <h1>{{ $title }}</h1>
        <sts-alert-list/>
    </section>
@endsection

