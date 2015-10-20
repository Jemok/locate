<head>

    <style type="text/css">
        
        body{
            background-color: gray;
        }

        .login{

            padding-top: 72px;
        }

    </style>


    <link  type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>


<div class="col-md-offset-4 col-md-5 login">

    <h3 class="text-center text-info">Login</h3>

    <form method="POST" action="/auth/login" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="text-center">Email</div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">

            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}
        </div>
        <div class="text-center">Password</div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <input type="password" name="password" id="password" class="form-control">
            {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="form-group text-center">
            <input type="checkbox" name="remember" class="checkbox-inline"> Remember Me
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success btn-group-lg">Login</button>
        </div>
    </form>
</div>
