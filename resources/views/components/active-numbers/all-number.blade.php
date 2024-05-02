<div class="an_wrapper">
    @foreach ($item->active_numbers as $an)
         <div class="an {{$an->sys_color}}">
            <span>{{ $an->sys_status }}</span>
            <span>{{ $an->type_pass }}</span>
            <span>{{ $an->pass_zone }}</span>
            <span>{{ $an->series }}-{{ $an->pass_number }}</span>
            <span>от {{ date("d.m.Y", strtotime($an->valid_from)) }}</span>
            <span>до {{ date("d.m.Y", strtotime($an->valid_to)) }}</span>
         </div>
    @endforeach
</div>
