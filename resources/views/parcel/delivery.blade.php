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

    <h3 class="text-center text-info">Delivery Status</h3>

    @if(isset($delivery))

    {!! Form::model($delivery, ['url' => '/parcel/delivery-update/', 'method' => 'POST', 'class' => 'form-horizontal'])!!}

        {!! csrf_field() !!}

        <div class="col-md-offset-2">
            <div class="radio">
                <label>
                    <input type="radio" name="deliveryStatus" id="optionsDeliveryStatus1" value="option1">
                    Deliver to agent
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deliveryStatus" id="optionsDeliveryStatus2" value="option2">
                    Agent Pick Up at Location
                </label>
            </div>
            <br>
            <label>Date</label>
            <div class="form-group {{ $errors->has('parcelDeliveryDate') ? 'has-error' : ''}}">
                {!! Form::text('parcelDeliveryDate', null, ['class' => 'form-control', 'id' => 'parcelDeliveryDate'])!!}
                {!! $errors->first('parcelDeliveryDate', '<span class="help-block">:message</span>' ) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="text-center form-group col-md-6">
                <a href="/delivery/back/"><button type="button" class="btn btn-warning">Previous</button></a>
            </div>

            <div class="text-center form-group col-md-6">
                <button type="submit" class="btn btn-success">Update and Finish</button>
            </div>

        </div>
    </form>


    @else

    <form method="POST" action="/parcel/delivery/" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="col-md-offset-2">
            <div class="radio">
                <label>
                    <input type="radio" name="deliveryStatus" id="optionsDeliveryStatus1" value="option1">
                    Deliver to agent
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deliveryStatus" id="optionsDeliveryStatus2" value="option2">
                    Agent Pick Up at Location
                </label>
            </div>
            <br>
            <label>Date</label>
            <div class="form-group {{ $errors->has('parcelDeliveryDate') ? 'has-error' : ''}}">
                <input type="text" name="parcelDeliveryDate" class="form-control">
                {!! $errors->first('parcelDeliveryDate', '<span class="help-block">:message</span>' ) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="text-center form-group col-md-6">
                <a href="/delivery/back/"><button type="button" class="btn btn-warning">Previous</button></a>
            </div>

            <div class="text-center form-group col-md-6">
                <button type="submit" class="btn btn-success">Finish</button>
            </div>

        </div>
    </form>

    @endif



</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>