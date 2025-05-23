<div id="main_side_menue" class="side_menue_wrapper">
    <div class="shadow"></div>
    <nav class="side_menue">
        <x-menues.menu-item title="Главная" icon="home_fill" :active="(Route::currentRouteName() === 'home')?true:false" :route="route('home')"></x-menues.menu-item>

        <h3 class="menu_h3">Номера</h3>
        <x-menues.menu-item title="Добавить номер" icon="pluss"  :active="(Route::currentRouteName() === 'create')?true:false" :route="route('create')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номера" icon="chart"  :active="(Route::currentRouteName() === 'add_many_numbers')?true:false" :route="route('add_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверить ГРЗ" icon="chec"  :active="(Route::currentRouteName() === 'check_number')?true:false" :route="route('check_number')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверить ГРЗ (сайт)" icon="chec"  :active="(Route::currentRouteName() === 'check_number_site')?true:false" :route="route('check_number_site')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая проверка номеров" icon="mass_ch" :active="(Route::currentRouteName() === 'check_many_numbers')?true:false" :route="route('check_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Лог событий" icon="log_list" :active="(Route::currentRouteName() === 'event_log')?true:false" :route="route('event_log')"></x-menues.menu-item>

        <h3 class="menu_h3">Аннуляция</h3>
        <x-menues.menu-item title="Экстренное оповещение" icon="megphon"  :active="(Route::currentRouteName() === 'express_notification')?true:false" :route="route('express_notification')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверка по номеру пропуска" icon="pass_icon" :active="(Route::currentRouteName() === 'updet_by_numbers')?true:false" :route="route('updet_by_numbers')"></x-menues.menu-item>

        <h3 class="menu_h3">Почта</h3>
        <x-menues.menu-item title="Массовая замена e-mail" icon="email_open" :active="(Route::currentRouteName() === 'email_chenge')?true:false" :route="route('email_chenge')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавление доп. E-mail" icon="email_chenge" :active="(Route::currentRouteName() === 'email_dop_add')?true:false" :route="route('email_dop_add')"></x-menues.menu-item>
        <x-menues.menu-item title="Удаление по E-mail" icon="dell_emeil" :active="(Route::currentRouteName() === 'delete_by_email')?true:false" :route="route('delete_by_email')"></x-menues.menu-item>
        <x-menues.menu-item title="Шаблоны E-mail" icon="template_emeil" :active="(Route::currentRouteName() === 'email_template_list')?true:false" :route="route('email_template_list')"></x-menues.menu-item>

        <h3 class="menu_h3">Должники</h3>
        <x-menues.menu-item title="Добавление должников" icon="person_add" :active="(Route::currentRouteName() === 'debtors_add')?true:false" :route="route('debtors_add')"></x-menues.menu-item>
        <x-menues.menu-item title="Удалить должника" icon="procent" :active="(Route::currentRouteName() === 'debtors_dashboard')?true:false" :route="route('debtors_dashboard')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверка должников" icon="deb_ch" :active="(Route::currentRouteName() === 'debtors_chek')?true:false" :route="route('debtors_chek')"></x-menues.menu-item>

        <h3 class="menu_h3">Должники</h3>
        <x-menues.menu-item title="Добавить ДК" icon="to_icon" :active="(Route::currentRouteName() === 'to_alert_list')?true:false" :route="route('to_alert_list')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить Штрафы" icon="fine_icon" :active="(Route::currentRouteName() === 'fine_alert_list')?true:false" :route="route('fine_alert_list')"></x-menues.menu-item>

        <div id="settings_app">
            <settings></settings>
        </div>
    </nav>


</div>

