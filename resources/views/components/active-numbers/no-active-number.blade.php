<div class="an_wrapper">
    @foreach ($item->no_active_numbers as $an)
         <div class="an {{$an->sys_color}}">
            <div class="b_head">
                @if ($an->type_pass === "Дневной")
                    <svg class="time_icon">
                        <use xlink:href="#sun"></use>
                    </svg>
                @else
                    <svg class="time_icon">
                        <use xlink:href="#moon"></use>
                    </svg>
                @endif

                <span>{{ $an->type_pass }}</span>
            </div>

            <div class="b_body">
                <span>{{ $an->sys_status }}</span>
                <span>{{ $an->pass_zone }}</span>
                <span>{{ $an->series }}-{{ $an->pass_number }}</span>
                <span>от {{ date("d.m.Y", strtotime($an->valid_from)) }}</span>
                <span>до {{ date("d.m.Y", strtotime($an->valid_to)) }}</span>
            </div>
         </div>
    @endforeach
</div>
