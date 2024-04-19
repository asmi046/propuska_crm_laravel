<table>
    <thead>
        <tr>
            <th>Госномер</th>
            <th>Тип пропуска</th>
            <th>Серия</th>
            <th>Номер пропуска</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Время</th>
            <th>Статус</th>
            <th>Осталось дней</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($info as $item)
            <tr @class([$item->sys_color]) >
                <td>{{ $item->truck_num }}</td>
                <td>{{ $item->pass_zone }}</td>
                <td>{{ $item->series }}</td>
                <td>{{ $item->pass_number }}</td>
                <td>{{ date('d.m.Y', strtotime($item->valid_from_parsed)) }}</td>
                <td>{{ date('d.m.Y', strtotime($item->valid_to_parsed)) }}</td>
                <td>{{ $item->type_pass}}</td>
                <td>{{ $item->sys_status }}</td>
                <td>{{ $item->deycount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
