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
