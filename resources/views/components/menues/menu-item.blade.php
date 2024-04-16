<a @class(['side_nav_item', 'active' => false]) href="{{ $route }}">
    <svg class="sprite_icon">
        <use xlink:href="#{{$icon}}"></use>
    </svg>
    <span>{{$title}}</span>
</a>
