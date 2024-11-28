@extends('layouts.all_interface')

@php
    $title = "Проверка должников по списку";
    $description = "Проверка должников по списку";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="debtors_chek" class="table_section">
        <h1>{{ $title }}</h1>
        <debtors-ch></debtors-ch>
    </section>
@endsection

