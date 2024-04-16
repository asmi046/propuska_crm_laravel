@extends('layouts.all_interface')

@php
    $title = "Портал по проверке пропусков";
    $description = "Портал по проверке пропусков";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <section class="table_section">
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
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <x-pagination :tovars="$numbers"></x-pagination>
    </section>
@endsection

