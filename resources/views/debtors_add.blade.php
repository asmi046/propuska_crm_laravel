@extends('layouts.all_interface')

@php
    $title = "Добавление должников в базу";
    $description = "Добавление должников в базу";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="debtors_add" class="table_section">
        <h1>{{ $title }}</h1>
        <debtors-add></debtors-add>
    </section>
@endsection
