@extends('layouts.all_interface')

@php
    $title = "Массовая замена E-mail";
    $description = "Массовая замена E-mail";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>
        <x-forms.mail-replace :action="route('email_chenge_do')"></x-forms.mail-replace>
    </section>
@endsection
