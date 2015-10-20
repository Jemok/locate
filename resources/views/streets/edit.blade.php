<link  type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<div class="container">
    @if(Session::has('flash_message'))

    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
</div>

<div style="padding-top: 50px">
<a href="/home" class="col-md-offset-2"><button class="btn btn-info">Home</button></a>

    <a href="/client/agent/"><button class="btn btn-info">Agent Dashboard</button></a>

    <a href="/street/add/"><button class="btn btn-info">Add Street</button></a>

<a href="/auth/logout" class="col-md-offset-5"><button class="btn btn-warning">Logout</button></a>
</div>
<div class="col-md-offset-3 col-md-5 register">

    @if(isset($street))

    <h3 class="text-center text-info">Street Details</h3>

    {!! Form::model($street, ['url' => '/street/update/'.$street->id, 'method' => 'PATCH', 'class' => 'form-horizontal'])!!}

    {!! csrf_field() !!}

    <div class="text-center">Street Key Name</div>
    <div class="form-group {{ $errors->has('streetKeyName') ? 'has-error' : ''}}">

        {!! Form::text('streetKeyName', null, ['class' => 'form-control', 'id' => 'streetKeyName'])!!}
        {!! $errors->first('streetKeyName', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Street Key Code</div>
    <div class="form-group {{ $errors->has('streetKeyCode') ? 'has-error' : ''}}"">
        {!! Form::text('streetKeyCode', null, ['class' => 'form-control', 'id' => 'streetKeyCode'])!!}
        {!! $errors->first('streetKeyCode', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Street Description</div>
    <div class="form-group {{ $errors->has('streetDescription') ? 'has-error' : ''}}"">
        {!! Form::text('streetDescription', null, ['class' => 'form-control', 'id' => 'streetDescription'])!!}
        {!! $errors->first('streetDescription', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">Update</button>
    </div>

    {!! Form::close() !!}

    @endif

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>