<a  onclick="if (!confirm('Запись будет удалено из заказа! Вы уверенны?')) return false;" @class(['control_item', 'active' => false]) href="{{ $route }}">
    <svg class="sprite_icon">
        <use xlink:href="#{{$icon}}"></use>
    </svg>
    <span>{{ $title }}</span>
</a>
