<head>

    <style type="text/css">

        .register{

            padding-top: 72px;
        }

    </style>

</head>


<link  type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<div class="col-md-offset-3 col-md-5 register">

    <h3 class="text-center text-info">Register</h3>

    <form method="POST" action="/auth/register" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="text-center">Email</div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Password</div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <input type="password" name="password" class="form-control">
            {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Repeat Password</div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Register</button>
        </div>
    </form>
</div>