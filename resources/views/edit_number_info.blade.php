@extends('layouts.all_interface')

@php
    $title = "Редактирование данных для номера ".$number_info->truc_number;
    $description = "Редактирование данных для номера ".$number_info->truc_number;
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>
        <x-forms.number-edit-form  :item="$number_info" :action="route('save_number_info')"></x-forms.number-edit-form>
    </section>
@endsection

