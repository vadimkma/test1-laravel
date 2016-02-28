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
            Controls
        </th>
    </thead>
    @foreach ($patients as $patient)
        <tr>
            <td>
                {!! $patient->name  !!}
            </td>
            <td>
                {!! $patient->surname  !!}
            </td>
            <td>
                <a href="{{ URL::to('patients/' . $patient->id . '/') }}" alt="view patient visits">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@include('layout.footer')
