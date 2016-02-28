@include('layout.header')
<div class="row">
    <div class="col-lg-4 col-lg-offset-4 ">
        <h1>User sign up</h1>
        <?php
        if(isset($errors) && $errors != null){?>
        <b style="color:red;">
            <?php echo $errors;?>
        </b>
        <?php
        }

        if(isset($success) && $success != null){?>
        <b>
            <?php echo $success;?>
        </b>
        <?php
        }
        ?>

        <?php echo Form::open(array('method'=>'post'));?>
        <?php echo Form::text('idTypeUser', '2', array('required', 'hidden'));?>
        <p>
            {{ Form::label('login', 'Login') }}<br>
            <?php echo Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'login', 'required'));?>
        </p>
        <p>
            {{ Form::label('password', 'Password') }}<br>
            <?php echo Form::password('password', array('class'=>'form-control','required'));?>
        </p>
        <p>
            {{ Form::label('remember', 'Remember me') }}<br>
            <?php echo Form::checkbox('remember', 1);?>
        </p>
        <?php   echo Form::button("login", array('class'=>'btn','type'=>'submit'));?>
        <?php echo Form::close();?>
    </div>
</div>
@include('layout.footer')