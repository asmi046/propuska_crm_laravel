<form method="POST" action="{{ $action }}">
    @csrf


    @if (session('number_info_save'))
        <div class="form-status form-status--success">{{ session('number_info_save') }}</div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">{{ $error }}</div>
    @endforeach

    <input type="hidden" name="item_id" value="{{ $item->id ?? ""}}">

    <div class="field">
        <label class="label">Госномер<sup>*</sup></label>
        <div class="control">
            <input name="truc_number" class="input p-inputtext p-component" value="{{ $item->truc_number  ?? "" }}" type="text" placeholder="Государственный регистрационный номер">
        </div>

        @error('truc_number')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">E-mail</label>
        <div class="control">
            <input name="email" class="input p-inputtext p-component" type="email" value="{{ $item->email ?? "" }}" placeholder="e-mail">
        </div>

        @error('email')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">E-mail дополнительный</label>
        <div class="control">
            <input name="email_dop" class="input p-inputtext p-component" type="email" value="{{ $item->email_dop ?? "" }}" placeholder="e-mail дополнительный">
        </div>

        @error('email_dop')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">E-mail дополнительный 2</label>
        <div class="control">
            <input name="email_dop2" class="input p-inputtext p-component" type="email" value="{{ $item->email_dop2 ?? "" }}" placeholder="e-mail дополнительный 2">
        </div>

        @error('email_dop2')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <div class="field">
        <label class="label">Телефон</label>
        <div class="control">
            <input name="phone" class="input p-inputtext p-component" type="tel" value="{{ $item->phone ?? "" }}" placeholder="Контактный телефон">
        </div>

        @error('phone')
            <p class="error">{{$message}}</p>
        @enderror
    </div>
    <button class="p-button p-component" type="submit">Сохранить изменения</button>
</form
