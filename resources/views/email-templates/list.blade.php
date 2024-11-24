@extends('layouts.all_interface')

@php
    $title = "Список шаблонов E-mail";
    $description = "Список шаблонов E-mail";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="email_templates" class="table_section">
        <h1>{{ $title }}</h1>
        <email-template-list action="{{ route('email_template_list_get') }}"></email-template-list>
    </section>
@endsection
