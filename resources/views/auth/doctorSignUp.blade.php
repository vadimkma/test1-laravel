@include('layout.header')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 ">
            <h1>Register doctor</h1>
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
                <?php echo Form::text('idTypeUser', '1', array('required', 'hidden'));?>
                <p>
                    {{ Form::label('name', 'Name') }}<br>
                    <?php echo Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'name', 'required'));?>
                </p>
                <p>
                    {{ Form::label('surname', 'Surname') }}<br>
                    <?php echo Form::text('surname', null, array('class'=>'form-control', 'placeholder'=>'surname', 'required'));?>
                </p>
                <p>
                    {{ Form::label('login', 'Login') }}<br>
                    <?php echo Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'login', 'required'));?>
                </p>
                <p>
                    {{ Form::label('password', 'Password') }}<br>
                    <?php echo Form::password('password', array('class'=>'form-control', 'required'));?>
                </p>
                <p>
                    {{ Form::label('password_confirmation', ' Confirm password') }}<br>
                    <?php echo Form::password('password_confirmation', array('class'=>'form-control', 'required'));?>
                </p>
                <?php   echo Form::button("Register", array('class'=>'btn', 'type'=>'submit'));?>
            <?php echo Form::close();?>
        </div>
    </div>
@include('layout.footer')