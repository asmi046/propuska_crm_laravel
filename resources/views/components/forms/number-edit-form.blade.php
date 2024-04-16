<form method="POST" action="{{ $action }}">
    @csrf


    @if (session('number_info_save'))
        <div class="form-status form-status--success">{{ session('number_info_save') }}</div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">{{ $error }}</div>
    @endforeach

    <input type="hidden" name="item_id" value="{{ $item->id ?? old('item_id') ?? ""}}">

    <div class="field">
        <label class="label">Госномер<sup>*</sup></label>
        <div class="control">
            <input name="truc_number" class="input" value="{{ $item->truc_number ?? old('truc_number') ?? "" }}" type="text" placeholder="Государственный регистрационный номер">
        </div>

        @error('truc_number')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">E-mail<sup>*</sup></label>
        <div class="control">
            <input name="email" class="input" type="email" value="{{ $item->email ?? old('email') ?? "" }}" placeholder="e-mail">
        </div>

        @error('email')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">E-mail дополнительный</label>
        <div class="control">
            <input name="email_dop" class="input" type="email" value="{{ $item->email_dop ?? old('email_dop') ?? "" }}" placeholder="e-mail">
        </div>

        @error('email_dop')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">Телефон</label>
        <div class="control">
            <input name="phone" class="input" type="tel" value="{{ $item->phone ?? old('phone') ?? "" }}" placeholder="Контактный телефон">
        </div>

        @error('phone')
            <p class="error">{{$message}}</p>
        @enderror
    </div>
    <button type="submit">Сохранить изменения</button>
</form
