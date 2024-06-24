@extends('layouts.all_interface')

@php
    $title = "Добавление доп. E-mail";
    $description = "Добавление доп. E-mail";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>
        <x-forms.email_dop_add :action="route('email_dop_add_do')"></x-forms.email_dop_add>
    </section>
@endsection
