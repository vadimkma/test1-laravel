@include('layout.header')
<h1 class="center">Edit permissions {!! Auth::user()->name.' '.Auth::user()->surname  !!}</h1>
<div class="row">
    <div class='col-md-6 col-md-offset-3'>
        {!! Form::open(array('method'=>'post')) !!}
        <p>
            {{ Form::label('permissions', 'Doctors') }}<br>

            {{ Form::select('permissions', $doctors, $doctorsSelected, [ 'name'=>'permissions[]', 'multiple'=>'multiple' ]) }}

        </p>
        {!!   Form::button("Save", array('class'=>'btn', 'type'=>'submit')) !!}
        {!!   Form::close() !!}
    </div>
</div>
@include('layout.footer')
