@include('layout.header')

{!! Form::open(array('method'=>'post')) !!}

<div class="row">
    <div class='col-md-6 col-md-offset-3'>
        <h1 class="center">New visit</h1>
        <br>
        <br>
        <?php
        if(isset($errors) && $errors != null){?>
        <b style="color:red;">
            <?php echo $errors;?>
        </b>
        <?php
        }?>
    </div>

    <div class='col-md-3 col-md-offset-3'>
        <div class="form-group">
            {{ Form::label('startDate', 'Date') }}<br>
            <div class='input-group date' id='datetimepicker1'>
                {!! Form::text("startDate",  null, array('class'=>'form-control')) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            {{ Form::label('time', 'Time') }}<br>
            <div class='input-group date' id='datetimepicker3'>
                {!! Form::text("time", null, array('class'=>'form-control')) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-6 col-md-offset-3'>
    <p class="center">
        {!! Form::button("Save", array('class'=>'btn', 'type'=>'submit')) !!}
    </p>
</div>


<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            daysOfWeekDisabled: [0, 6],
            format: "YYYY-MM-DD HH:mm",
            locale: 'en'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'HH:mm'
        });

    });
</script>

@include('layout.footer')



