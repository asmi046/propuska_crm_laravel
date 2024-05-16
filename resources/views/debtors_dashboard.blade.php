@extends('layouts.all_interface')

@php
    $title = "База должников";
    $description = "База должников";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
        <h1>{{ $title }}</h1>

        <x-forms.debtor-filter></x-forms.debtor-filter>

        <div class="table_wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Госномер</th>
                        <th>e-mail</th>
                        <th>Дата добавления</th>
                        <th>Просрочено дней</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($debtors as $item)
                        <tr>
                            <td>{{ $item->truc_number }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ date("d.m.Y", strtotime($item->adding_data)) }}</td>
                            <td>{{ $item->deys }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <x-pagination :tovars="$debtors"></x-pagination>

    </section>
@endsection
