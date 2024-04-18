<form class="check_truc_number_form" action="{{ $action }}" method="GET">
    @if (session('number_info_save'))
        <div class="form-status form-status--success">{{ session('number_info_save') }}</div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">{{ $error }}</div>
    @endforeach

    <div class="field">
        <div class="control">
            <input name="truc_number" class="input" value="{{ $number ?? "" }}" type="text" placeholder="Государственный регистрационный номер">
        </div>

        @error('truc_number')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <button type="submit">Проверить</button>
</form>
