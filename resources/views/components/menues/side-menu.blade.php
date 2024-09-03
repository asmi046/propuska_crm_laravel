<div id="main_side_menue" class="side_menue_wrapper">
    <div class="shadow"></div>
    <nav class="side_menue">
        <x-menues.menu-item title="Главная" icon="home_fill" :active="(Route::currentRouteName() === 'home')?true:false" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номер" icon="pluss"  :active="(Route::currentRouteName() === 'create')?true:false" :route="route('create')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номера" icon="chart"  :active="(Route::currentRouteName() === 'add_many_numbers')?true:false" :route="route('add_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверить номер" icon="chec"  :active="(Route::currentRouteName() === 'check_number')?true:false" :route="route('check_number')"></x-menues.menu-item>
        <x-menues.menu-item title="Экстренное оповещение" icon="megphon"  :active="(Route::currentRouteName() === 'express_notification')?true:false" :route="route('express_notification')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая проверка номеров" icon="mass_ch" :active="(Route::currentRouteName() === 'check_many_numbers')?true:false" :route="route('check_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая замена e-mail" icon="email_open" :active="(Route::currentRouteName() === 'email_chenge')?true:false" :route="route('email_chenge')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавление доп. E-mail" icon="email_chenge" :active="(Route::currentRouteName() === 'email_dop_add')?true:false" :route="route('email_dop_add')"></x-menues.menu-item>
        <x-menues.menu-item title="Обновление по номеру пропуска" icon="pass_icon" :active="(Route::currentRouteName() === 'updet_by_numbers')?true:false" :route="route('updet_by_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Удаление по E-mail" icon="dell_emeil" :active="(Route::currentRouteName() === 'delete_by_email')?true:false" :route="route('delete_by_email')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавление должников" icon="person_add" :active="(Route::currentRouteName() === 'debtors_add')?true:false" :route="route('debtors_add')"></x-menues.menu-item>
        <x-menues.menu-item title="Управление должниками" icon="procent" :active="(Route::currentRouteName() === 'debtors_dashboard')?true:false" :route="route('debtors_dashboard')"></x-menues.menu-item>
    </nav>
</div>

