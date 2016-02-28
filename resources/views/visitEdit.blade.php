@include('layout.header')

<h1>Edit comment visit #{!! $visit->id  !!}</h1>

{!! Form::open(array('method'=>'post')) !!}
    <p>
        {{ Form::label('comment', 'Comment') }}<br>
        <?php echo Form::textarea('comment', $visit->comment, array('class'=>'form-control', 'placeholder'=>'Your comment'));?>
    </p>
{!!   Form::button("Save", array('class'=>'btn', 'type'=>'submit')) !!}
{!!   Form::close() !!}


@include('layout.footer')
