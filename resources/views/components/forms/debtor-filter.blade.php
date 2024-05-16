<form class="filter_debtor_form" action="{{ route('debtors_dashboard') }}">

    <div class="field">
        <div class="control">
            <input name="serch" class="input" type="text" value="{{ request('serch') ?? old('serch') ?? "" }}" placeholder="Искать по госномеру или e-mail ">
        </div>
    </div>
    <div class="control_line">
        <button type="submit">Найти</button>
        <a href="{{ route('debtors_dashboard') }}"> Сбросить фильтр</a>
    </div>
</form>
<br>
