@extends('layouts.all_interface')

@php
    $title = "Проверить информацию по номеру";
    $description = "Проверить информацию по номеру";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>
        <x-forms.check-truck-numbet-form :number="$number" :action="route('check_number')"></x-forms.check-truck-numbet-form>

        @if ($info)
            <br>
            <x-tables.number-info-table :info="$info"></x-tables.number-info-table>
        @else
            <br>
            <strong>По вашему запросу ничего не найдено</strong>
        @endif



    </section>
@endsection