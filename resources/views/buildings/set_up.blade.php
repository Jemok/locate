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
    <a href="/client/agent/"><button class="btn btn-info">AgentDashboard</button></a>
    <a href="/street/manage/"><button class="btn btn-info">Streets</button></a>


<a href="/auth/logout" class="col-md-offset-5"><button class="btn btn-warning">Logout</button></a>

</div>

<div class="col-md-offset-3 col-md-5 register">

<h3 class="text-center text-info">Add</h3>

<form method="POST" action="/street-building/register/{{ $id }}" class="form-horizontal">
    {!! csrf_field() !!}

    <div class="text-center">Building Key Code</div>
    <div class="form-group {{ $errors->has('buildingKeyCode') ? 'has-error' : ''}}">
        <input type="text" name="buildingKeyCode" class="form-control">
        {!! $errors->first('buildingKeyCode', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Building Key Name</div>
    <div class="form-group {{ $errors->has('buildingKeyName') ? 'has-error' : ''}}"">
        <input type="text" name="buildingKeyName"  class="form-control">
        {!! $errors->first('buildingKeyName', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Number of levels </div>
    <div class="form-group {{ $errors->has('numberOfLevels') ? 'has-error' : ''}}"">
        <input type="text" name="numberOfLevels"  class="form-control">
        {!! $errors->first('numberOfLevels', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">Register Building</button>
    </div>
</form>


</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>