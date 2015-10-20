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
    <a href="/client/citizen/"><button class="btn btn-info">Citizen Dashboard</button></a>


    <a href="/auth/logout" class="col-md-offset-5"><button class="btn btn-warning">Logout</button></a>
</div>

<div class="col-md-offset-3 col-md-5 register">

    <h3 class="text-center text-info">Your Parcel Details</h3>

    @if(isset($parcel))

    {!! Form::model($parcel, ['url' => '/parcel/details-edit-update/'. $parcelId, 'method' => 'POST', 'class' => 'form-horizontal'])!!}
    {!! csrf_field() !!}

    <div class="text-center">Your Parcel Name</div>
    <div class="form-group {{ $errors->has('parcelName') ? 'has-error' : ''}}">
        {!! Form::text('parcelName', null, ['class' => 'form-control', 'id' => 'parcelName'])!!}
        {!! $errors->first('parcelName', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Your Parcel Weight</div>
    <div class="form-group {{ $errors->has('parcelWeight') ? 'has-error' : ''}}">
        {!! Form::text('parcelWeight', null, ['class' => 'form-control', 'id' => 'parcelWeight'])!!}
        {!! $errors->first('parcelWeight', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div>

        <p class="text-center">Parcel Category</p>

        <select name="parcelCategory" class="form-control">
            <option value="food">Food</option>
            <option value="electronic">Electronic</option>
            <option value="clothing">Clothing</option>
            <option value="furniture">Furniture</option>
        </select>

    </div>

    <br>

    <div class="text-center form-group">
        <button type="submit" class="btn btn-success">Update</button>
    </div>

    </form>

    @else

    <form method="POST" action="/parcel/send/" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="text-center">Your Parcel Name</div>
        <div class="form-group {{ $errors->has('parcelName') ? 'has-error' : ''}}">
            <input type="text" name="parcelName" class="form-control">
            {!! $errors->first('parcelName', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Your Parcel Weight</div>
        <div class="form-group {{ $errors->has('parcelWeight') ? 'has-error' : ''}}">
            <input type="text" name="parcelWeight" class="form-control">
            {!! $errors->first('parcelWeight', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div>

            <p class="text-center">Parcel Category</p>

            <select name="parcelCategory" class="form-control">
                <option value="food">Food</option>
                <option value="electronic">Electronic</option>
                <option value="clothing">Clothing</option>
                <option value="furniture">Furniture</option>
            </select>

        </div>

        <br>

        <div class="text-center form-group">
            <button type="submit" class="btn btn-success">Next</button>
        </div>

    </form>

    @endif
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>