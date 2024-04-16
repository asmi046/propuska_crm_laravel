@extends('layouts.all_interface')

@php
    $title = "Создание нового номера в базе";
    $description = "Создание нового номера в базе";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>
        <x-forms.number-edit-form  :item="null" :action="route('create_number_info')"></x-forms.number-edit-form>
    </section>
@endsection

