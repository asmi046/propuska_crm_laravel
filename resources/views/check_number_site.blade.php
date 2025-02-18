@extends('layouts.all_interface')

@php
    $title = "Проверить информацию по номеру (как на сайте)";
    $description = "Проверить информацию по номеру (как на сайте)";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="check_number" class="table_section">
        <h1>{{ $title }}</h1>

        <check-number number="{{$number}}" action="{{route('check_number_site')}}" :grndata="{{ json_encode($info) }}" ></check-number>

    </section>
@endsection
