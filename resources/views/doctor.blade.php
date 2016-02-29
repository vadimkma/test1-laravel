@include('layout.header')

<h1 class="center">{!! Auth::user()->name.' '.Auth::user()->surname  !!}</h1>
<hr>
<br>
{!! Form::open(array('method'=>'post')) !!}
<div class="row">
    <div class='col-md-4'>
            <a class="btn btn-primary" href="{{ URL::to('patients') }}" alt="list patients">
                List patients
            </a>
            <a class="btn btn-primary" href="{{ URL::to('doctors') }}" alt="list doctors">
                List doctors
            </a>
            <a class="btn btn-primary" href="{{ URL::to('permissions') }}" alt="set permissions">
                Set permissions
            </a>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                {!! Form::text("startDate",  null, array('class'=>'form-control')) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                {!! Form::text("endDate", null, array('class'=>'form-control')) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-1'>
        <p class="center">
            {!! Form::button("search", array('class'=>'btn', 'type'=>'submit')) !!}
        </p>
    </div>


    </div>
</div>
{!! Form::close() !!}
<?php
if(isset($sumHours) && $sumHours != null){?>
<b>
    <?php echo 'Summary work time '.$sumHours.' hours';?>
</b>
<?php
}
?>
<br>
<div class="monthly" id="mycalendar"></div>
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
        <th>
            Controls
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
            <td>
                <a href="{{ URL::to('visit/' . $visit->id . '/edit') }}" alt="comment edit">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                </a>
                @if ($visit->active == 1)
                    <a href="{{ URL::to('visit/' . $visit->id . '/cancel') }}" alt="cancel visit">
                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
<script type="text/javascript">

</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
            daysOfWeekDisabled: [0, 6],
            format: "YYYY-MM-DD HH:mm",
            locale: 'en'
        });
        $('#datetimepicker7').datetimepicker({
            daysOfWeekDisabled: [0, 6],
            format: "YYYY-MM-DD HH:mm",
            locale: 'en'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);

        });
    });
</script>
@include('layout.footer')
