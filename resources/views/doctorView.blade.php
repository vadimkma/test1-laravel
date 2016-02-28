@include('layout.header')
<h1 class="center">{!! Auth::user()->name.' '.Auth::user()->surname  !!}</h1>
<hr>
<br>
<table class="table">
    <thead>
        <th>
            Name
        </th>
        <th>
            Surname
        </th>
        <th>
            Start visit
        </th>
        <th>
            Time
        </th>
        <th>
            Comment
        </th>
        <th>
            Active
        </th>
    </thead>
    @foreach ($visits as $visit)
        <tr class="<?php if ($visit->active != 1){ echo 'danger'; }else{ echo 'active'; } ?>" >
            <td>
                {!! $visit->name  !!}
            </td>
            <td>
                {!! $visit->surname  !!}
            </td>
            <td>
                {!! $visit->startVisit  !!}
            </td>
            <td>
                {!! $visit->endVisit  !!}
            </td>
            <td>
                {!! $visit->comment  !!}
            </td>
            <td>
                @if ($visit->active == 1)
                    true
                @else
                    false
                @endif
            </td>
        </tr>
    @endforeach
</table>
@include('layout.footer')
