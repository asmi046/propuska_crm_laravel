@extends('layouts.all_interface')

@php
    $title = "Портал по проверке пропусков";
    $description = "Портал по проверке пропусков";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        @if (session('number_info_save'))
            <div class="form-status form-status--success">{{ session('number_info_save') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Госномер</th>
                    <th>e-mail</th>
                    <th>e-mail доп.</th>
                    <th>Телефон</th>
                    <th>Активные номера</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($numbers as $item)
                    <tr>
                        <td>{{ $item->truc_number }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->email_dop }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>

                                <div class="an_wrapper">
                                    @foreach ($item->active_numbers as $an)
                                         <div class="an">
                                            {{ $an->type_pass }} {{ $an->series }}-{{ $an->pass_number }} до {{ date("d.m.Y", strtotime($an->valid_to)) }}
                                         </div>

                                    @endforeach
                                </div>

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

        <x-pagination :tovars="$numbers"></x-pagination>
    </section>
@endsection

