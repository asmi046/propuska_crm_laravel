<div id="main_side_menue" class="side_menue_wrapper">
    <div class="shadow"></div>
    <nav class="side_menue">
        <x-menues.menu-item title="Главная" icon="home_fill" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номер" icon="pluss" :route="route('create')"></x-menues.menu-item>
        <x-menues.menu-item title="Добавить номера" icon="chart" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Проверить номер" icon="chec" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Экстренное оповещение" icon="megphon" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Массовая проверка номеров" icon="mass_ch" :route="route('home')"></x-menues.menu-item>
        <x-menues.menu-item title="Управление должниками" icon="procent" :route="route('home')"></x-menues.menu-item>
    </nav>
</div>

