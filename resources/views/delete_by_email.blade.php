@extends('layouts.all_interface')

@php
    $title = "Удаление номеров по e-mail";
    $description = "Удаление номеров по e-mail";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section" id="delete_by_email">
        <h1>{{ $title }}</h1>
        <delete-by-email></delete-by-email>
    </section>
@endsection

