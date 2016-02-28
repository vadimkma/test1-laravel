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
    @foreach ($doctors as $doctor)
        <tr>
            <td>
                {!! $doctor->name  !!}
            </td>
            <td>
                {!! $doctor->surname  !!}
            </td>
            <td>
                <a href="{{ URL::to('doctors/' . $doctor->id . '/') }}" alt="view doctors visits">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@include('layout.footer')
