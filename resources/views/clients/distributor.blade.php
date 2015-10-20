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


<h3 class="lead text-center">Client-Distributor page:: Manage your distributor status here:</h3>
<a href="/home" class="col-md-offset-1"><button class="btn btn-default">Back Home</button></a>


<a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-default">Logout</button></a>

<div class="col-md-offset-3 col-md-5 register">



    @if(isset($distributor))

    <h3 class="text-center">Distributor Details..................</h3>


    {!! Form::model($distributor, ['url' => '/distributor/update/'.$distributor->id, 'method' => 'PATCH', 'class' => 'form-horizontal'])!!}

         {!! csrf_field() !!}

        <div class="text-center">Distributor ID:</div>
        <div class="form-group {{ $errors->has('distributorId') ? 'has-error' : ''}}">

            {!! Form::text('distributorId', null, ['class' => 'form-control', 'id' => 'distributorId'])!!}
            {!! $errors->first('distributorId', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Distributor Name:</div>
        <div class="form-group {{ $errors->has('distributorName') ? 'has-error' : ''}}"">
            {!! Form::text('distributorName', null, ['class' => 'form-control', 'id' => 'distributorName'])!!}
            {!! $errors->first('distributorName', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>

    {!! Form::close() !!}

@else

<h3 class="text-center">Distributor Registration..................</h3>

<form method="POST" action="/distributor/register" class="form-horizontal">
    {!! csrf_field() !!}

    <div class="text-center">Distributor ID:</div>
    <div class="form-group {{ $errors->has('distributorId') ? 'has-error' : ''}}">
        <input type="text" name="distributorId" class="form-control">
        {!! $errors->first('distributorId', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Distributor Name:</div>
    <div class="form-group {{ $errors->has('distributorName') ? 'has-error' : ''}}"">
        <input type="text" name="distributorName"  class="form-control">
        {!! $errors->first('distributorName', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
</form>

@endif

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>