@extends('layouts.all_interface')

@php
    $title = "База должников";
    $description = "База должников";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section id="debtors_list" class="table_section">
        <h1>{{ $title }}</h1>

        <debtors-list action="{{ route('debtors_dashboard_get') }}" session="{{ session('number_deleted') }}" ></debtors-list>

        {{-- <x-forms.debtor-filter></x-forms.debtor-filter>

        @if (session('number_deleted'))
            <div class="form-status form-status--success">{{ session('number_deleted') }}</div>
        @endif

        <div class="table_wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Госномер</th>
                        <th>e-mail</th>
                        <th>Дата добавления</th>
                        <th>Просрочено дней</th>
                        <th>Управление</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debtors as $item)
                        <tr>
                            <td>{{ $item->truc_number }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ date("d.m.Y", strtotime($item->adding_data)) }}</td>
                            <td>{{ $item->deys }}</td>
                            <td>
                                <x-controls.lnk-icon-delete title="Удалить" icon="trash" :route="route('debtors_dell', $item->id)"></x-controls.lnk-icon-delete>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <x-pagination :tovars="$debtors"></x-pagination> --}}

    </section>
@endsection
