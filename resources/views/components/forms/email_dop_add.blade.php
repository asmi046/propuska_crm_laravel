<form method="POST" action="{{ $action }}">
    @csrf

    @if (session('email_dop_add'))
        <div class="form-status form-status--success">{{ session('email_dop_add') }}</div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">{{ $error }}</div>
    @endforeach

    <div class="field">
        <label class="label">Основной E-mail<sup>*</sup></label>
        <div class="control">
            <input name="email" class="input p-inputtext p-component" type="email" value="{{ $item->email ?? old('email') ?? "" }}" placeholder="Основной e-mail">
        </div>
    </div>

    <div class="field">
        <label class="label">Вставляемый дополнительный E-mail</label>
        <div class="control">
            <input name="new_email" class="input p-inputtext p-component" type="email" value="{{ $item->email ?? old('new_email') ?? "" }}" placeholder="Дополнительный e-mail">
        </div>
    </div>
    <div class="field">
        <label class="label">Вставляемый дополнительный E-mail 2</label>
        <div class="control">
            <input name="new_email2" class="input p-inputtext p-component" type="email" value="{{ $item->email ?? old('new_email2') ?? "" }}" placeholder="Дополнительный e-mail 2">
        </div>
    </div>

    <button class="p-button p-component" type="submit">Заменить e-mail</button>
</form>
