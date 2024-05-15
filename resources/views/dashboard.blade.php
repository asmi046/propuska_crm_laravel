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

        <form class="filter_form" action="{{ route('home') }}">
            <div class="field">
                <div class="control">
                    <select name="sys_statuse" id="">
                        <option disabled selected value="%">Все статусы</option>
                        <option @selected(request('sys_statuse') === "Начинается сегодня") value="Начинается сегодня">Начинается сегодня</option>
                        <option @selected(request('sys_statuse') === "Начинается завтра") value="Начинается завтра">Начинается завтра</option>
                        <option @selected(request('sys_statuse') === "Действует") value="Действует">Действует</option>
                        <option @selected(request('sys_statuse') === "Закончился") value="Закончился">Закончился</option>
                        <option @selected(request('sys_statuse') === "Заканчивается завтра") value="Заканчивается завтра">Заканчивается завтра</option>
                        <option @selected(request('sys_statuse') === "Заканчивается сегодня") value="Заканчивается сегодня">Заканчивается сегодня</option>
                        <option @selected(request('sys_statuse') === "Анулирован") value="Анулирован">Анулирован</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <select name="series" id="">
                        <option disabled selected value="%">Все типы пропусков</option>
                        <option @selected(request('series') === "ББ") value="ББ">ББ</option>
                        <option @selected(request('series') === "БА") value="БА">БА</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input name="serch" class="input" type="text" value="{{ request('serch') ?? old('serch') ?? "" }}" placeholder="Искать по госномеру или e-mail ">
                </div>
            </div>
            <div class="control_line">
                <button type="submit">Найти</button>
                <a href="{{ route('home') }}"> Сбросить фильтр</a>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Госномер</th>
                    <th>e-mail</th>
                    <th>e-mail доп.</th>
                    <th>Телефон</th>
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
                        <td>{{ $item->email_dop }}</td>
                        <td>{{ $item->phone }}</td>
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

        <x-pagination :tovars="$numbers"></x-pagination>
    </section>
@endsection

