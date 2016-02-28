@include('layout.header')
<h1 class="center">{!! Auth::user()->name.' '.Auth::user()->surname  !!}</h1>
<hr>
<br>
<a class="btn btn-primary" href="{{ URL::to('visit/create') }}" role="button">New visit</a>
<table class="table">
    <thead>
        <th>
            Doctor
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
        <th>
            Controls
        </th>
    </thead>
    @foreach ($visits as $visit)
        <tr class="<?php if ($visit->active != 1){ echo 'danger'; }else{ echo 'active'; } ?>" >
            <td>
                {!! $visit->name  !!} {!! $visit->surname  !!}
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
            <td>
                @if ($visit->active == 1)
                    <a href="{{ URL::to('visit/' . $visit->id . '/cancel') }}" alt="cancel visit">
                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
@include('layout.footer')
