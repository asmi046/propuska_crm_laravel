@extends('layouts.all_interface')

@php
    $title = "Портал по проверке пропусков";
    $description = "Портал по проверке пропусков";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section" id="main_page">
        @if (session('number_info_save'))
            <div class="form-status form-status--success">{{ session('number_info_save') }}</div>
        @endif

        <main-page></main-page>

        {{-- <x-forms.main-filter></x-forms.main-filter>

        <table>
            <thead>
                <tr>
                    <th>Госномер</th>
                    <th>e-mail</th>
                    <th>Активные пропуска</th>
                    <th>Последние пропуска</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($numbers as $item)
                    <tr>
                        <td>{{ $item->truc_number }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <x-active-numbers.all-number :item="$item"></x-active-numbers.all-number>
                        </td>
                        <td>
                            <x-active-numbers.no-active-number :item="$item"></x-active-numbers.no-active-number>
                        </td>
                        <td>
                            <x-controls.lnk-icon title="Подробнее" icon="information" :route="route('check_number', $item->truc_number )"></x-controls.lnk-icon>
                            <x-controls.lnk-icon title="Обновить" icon="refresh" :route="route('update_number_info', $item->id)"></x-controls.lnk-icon>
                            <x-controls.lnk-icon title="Редактировать" icon="edit_pen" :route="route('edit_number_info', $item->id)"></x-controls.lnk-icon>
                            <x-controls.lnk-icon-delete title="Удалить" icon="trash" :route="route('delete_number', $item->id)"></x-controls.lnk-icon-delete>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <x-pagination :tovars="$numbers"></x-pagination> --}}
    </section>
@endsection

