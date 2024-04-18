<div id="main_side_menue" class="side_menue_wrapper">
    <div class="shadow"></div>
    <nav class="side_menue">
        <x-menues.menu-item title="Главная" icon="home_fill" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номер" icon="pluss" :route="route('create')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номера" icon="chart" :route="route('add_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверить номер" icon="chec" :route="route('check_number')"></x-menues.menu-item>
        <x-menues.menu-item title="Экстренное оповещение" icon="megphon" :route="route('express_notification')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая проверка номеров" icon="mass_ch" :route="route('check_many_numbers')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая замена e-mail" icon="email_open" :route="route('email_chenge')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавление должников" icon="person_add" :route="route('debtors_add')"></x-menues.menu-item>
        <x-menues.menu-item title="Управление должниками" icon="procent" :route="route('debtors_dashboard')"></x-menues.menu-item>
    </nav>
</div>

