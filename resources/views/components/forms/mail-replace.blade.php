<form method="POST" action="{{ $action }}">
    @csrf

    @if (session('email_chenget'))
        <div class="form-status form-status--success">{{ session('email_chenget') }}</div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">{{ $error }}</div>
    @endforeach

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
        <label class="label">Новый E-mail<sup>*</sup></label>
        <div class="control">
            <input name="new_email" class="input" type="email" value="{{ $item->email ?? old('new_email') ?? "" }}" placeholder="Новый e-mail">
        </div>

        @error('new_email')
            <p class="error">{{$message}}</p>
        @enderror
    </div>

    <button type="submit">Заменить e-mail</button>
</form>
