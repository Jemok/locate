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

<div style="padding-top: 50px;">
<a href="/home" class="col-md-offset-1"><button class="btn btn-info">Home</button></a>

<a href="/street/add/"><button class="btn btn-info">Add Street</button></a>
<a href="/street/manage/"><button class="btn btn-info">Streets ({{ $streetCount }}) </button></a>


<a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-warning">Logout</button></a>

</div>
<div class="col-md-offset-3 col-md-4 register">



    @if(isset($agent))

    <h3 class="text-center text-info">Agent Details</h3>


    {!! Form::model($agent, ['url' => '/agent/update/'.$agent->id, 'method' => 'PATCH', 'class' => 'form-horizontal'])!!}

            {!! csrf_field() !!}

        <div class="text-center">Business No:</div>
        <div class="form-group {{ $errors->has('businessNumber') ? 'has-error' : ''}}">
            {!! Form::text('businessNumber', null, ['class' => 'form-control', 'id' => 'businessNumber']) !!}
            {!! $errors->first('businessNumber', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Agent Name:</div>
        <div class="form-group {{ $errors->has('agentName') ? 'has-error' : ''}}"">
            {!! Form::text('agentName', null, ['class' => 'form-control', 'id' => 'agentName'])!!}
            {!! $errors->first('agentName', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Agent Email:</div>
        <div class="form-group {{ $errors->has('agentEmail') ? 'has-error' : ''}}"">
            {!! Form::text('agentEmail', null, ['class' => 'form-control', 'id' => 'agentEmail'])!!}
            {!! $errors->first('agentEmail', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Mobile Number</div>
        <div class="form-group {{ $errors->has('agentMobileNumber') ? 'has-error' : ''}}"">
            {!! Form::text('agentMobileNumber', null, ['class' => 'form-control', 'id' => 'agentMobileNumber'])!!}
            {!! $errors->first('agentMobileNumber', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Opening Hour WeekDay:</div>
        <div class="form-group {{ $errors->has('openingHourWeekDay') ? 'has-error' : ''}}"">
            {!! Form::text('openingHourWeekDay', null, ['class' => 'form-control', 'id' => 'openingHourWeekDay'])!!}
            {!! $errors->first('openingHourWeekDay', '<span class="help-block">:message</span>' ) !!}
        </div>


        <div class="text-center">Closing Hour WeekDay</div>
        <div class="form-group {{ $errors->has('closingHourWeekDay') ? 'has-error' : ''}}"">
            {!! Form::text('closingHourWeekDay', null ,  ['class' => 'form-control', 'id' => 'closingHourWeekDay'])!!}
            {!! $errors->first('closingHourWeekDay', '<span class="help-block">:message</span>' ) !!}
        </div>


        <div class="text-center">Opening Hour Saturday:</div>
        <div class="form-group {{ $errors->has('openingHourSaturday') ? 'has-error' : ''}}"">
             {!! Form::text('openingHourSaturday', null ,  ['class' => 'form-control', 'id' => 'openingHourSaturday'])!!}
             {!! $errors->first('openingHourSaturday', '<span class="help-block">:message</span>' ) !!}
        </div>


        <div class="text-center">Closing Hour Saturday</div>
        <div class="form-group {{ $errors->has('closingHourSaturday') ? 'has-error' : ''}}"">
            {!! Form::text('closingHourSaturday', null ,  ['class' => 'form-control', 'id' => 'closingHourSaturday'])!!}
            {!! $errors->first('closingHourSaturday', '<span class="help-block">:message</span>' ) !!}
        </div>

        <div class="text-center">Opening Hour Sunday:</div>
        <div class="form-group {{ $errors->has('openingHourSunday') ? 'has-error' : ''}}"">
            {!! Form::text('openingHourSunday', null ,  ['class' => 'form-control', 'id' => 'openingHourSunday'])!!}
            {!! $errors->first('openingHourSunday', '<span class="help-block">:message</span>' ) !!}
        </div>


        <div class="text-center">Closing Hour Sunday</div>
        <div class="form-group {{ $errors->has('closingHourSunday') ? 'has-error' : ''}}"">
            {!! Form::text('closingHourSunday', null ,  ['class' => 'form-control', 'id' => 'closingHourSunday'])!!}
            {!! $errors->first('closingHourSunday', '<span class="help-block">:message</span>' ) !!}
        </div>



        <div class="text-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    {!! Form::close() !!}

@else

<h3 class="text-center text-info">Agent Registration</h3>

<form method="POST" action="/agent/register" class="form-horizontal">
    {!! csrf_field() !!}

    <div class="text-center">Business No:</div>
    <div class="form-group {{ $errors->has('businessNumber') ? 'has-error' : ''}}">
        <input type="text" name="businessNumber" class="form-control">
        {!! $errors->first('businessNumber', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Agent Name:</div>
    <div class="form-group {{ $errors->has('agentName') ? 'has-error' : ''}}"">
    <input type="text" name="agentName"  class="form-control">
    {!! $errors->first('agentName', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Agent Email:</div>
    <div class="form-group {{ $errors->has('agentEmail') ? 'has-error' : ''}}"">
    <input type="text" name="agentEmail"  class="form-control">
    {!! $errors->first('agentEmail', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Mobile Number</div>
    <div class="form-group {{ $errors->has('agentMobileNumber') ? 'has-error' : ''}}"">
    <input type="text" name="agentMobileNumber"   class="form-control">
    {!! $errors->first('agentMobileNumber', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Opening Hour WeekDay:</div>
    <div class="form-group {{ $errors->has('openingHourWeekDay') ? 'has-error' : ''}}"">
    <input type="text" name="openingHourWeekDay"  class="form-control">
    {!! $errors->first('openingHourWeekDay', '<span class="help-block">:message</span>' ) !!}
    </div>


    <div class="text-center">Closing Hour WeekDay</div>
    <div class="form-group {{ $errors->has('closingHourWeekDay') ? 'has-error' : ''}}"">
    <input type="text" name="closingHourWeekDay"   class="form-control">
    {!! $errors->first('closingHourWeekDay', '<span class="help-block">:message</span>' ) !!}
    </div>


    <div class="text-center">Opening Hour Saturday:</div>
    <div class="form-group {{ $errors->has('openingHourSaturday') ? 'has-error' : ''}}"">
    <input type="text" name="openingHourSaturday"   class="form-control">
    {!! $errors->first('openingHourSaturday', '<span class="help-block">:message</span>' ) !!}
    </div>


    <div class="text-center">Closing Hour Saturday</div>
    <div class="form-group {{ $errors->has('closingHourSaturday') ? 'has-error' : ''}}"">
    <input type="text" name="closingHourSaturday"  class="form-control">
    {!! $errors->first('closingHourSaturday', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">Opening Hour Sunday:</div>
    <div class="form-group {{ $errors->has('openingHourSunday') ? 'has-error' : ''}}"">
        <input type="text" name="openingHourSunday"   class="form-control">
        {!! $errors->first('openingHourSunday', '<span class="help-block">:message</span>' ) !!}
    </div>


    <div class="text-center">Closing Hour Sunday</div>
    <div class="form-group {{ $errors->has('closingHourSunday') ? 'has-error' : ''}}"">
        <input type="text" name="closingHourSunday"  class="form-control">
        {!! $errors->first('closingHourSunday', '<span class="help-block">:message</span>' ) !!}
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
</form>

@endif

</div>

<div class="col-md-5" style="padding-top: 40px;">

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">To Pick</td>
        </tr>



        @if($parcelsToPick->count())
        @foreach($parcelsToPick->with('parcel', 'address')->get() as $toPick)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $toPick->parcel->parcelWeight }} (Kgs) -
                {{ $toPick->parcel->parcelName }}
                - from {{ $toPick->address->address }}
            </td>

            @if($toPick->ship_status == 1)

            <td><a href="/parcel/pick/{{ $toPick->id }}"><button class="btn btn-warning">Set Picked</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No parcels to pick</td>
        </tr>

        @endif
    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Picked From Citizens</td>
        </tr>

        @if($parcelsPicked->count())
        @foreach($parcelsPicked->with('parcel', 'address')->get() as $picked)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $picked->parcel->parcelWeight }} (Kgs) -
                {{ $picked->parcel->parcelName }}
                - from {{ $picked->address->address }}
            </td>


            @if($picked->ship_status == 2)

            <td><a href="/parcel/ship/{{ $picked->id }}"><button class="btn btn-info">Ship</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Picked Parcels</td>
        </tr>

        @endif
    </table>


    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Shipped</td>
        </tr>



        @if($parcelsOnTransit->count())
        @foreach($parcelsOnTransit->with('parcel', 'address')->get() as $onTransit)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $onTransit->parcel->parcelWeight }} (Kgs) -
                {{ $onTransit->parcel->parcelName }}
                - from {{ $onTransit->address->address }}
            </td>


            @if($onTransit->ship_status == 3)

            <td><a href=""><button class="btn btn-info">View Details</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Parcels On Transit</td>
        </tr>

        @endif
    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Incoming</td>
        </tr>

        @if($parcelsIncoming->count())
        @foreach($parcelsIncoming->with('parcel', 'address')->get() as $incoming)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $incoming->parcel->parcelWeight }} (Kgs) -
                {{ $incoming->parcel->parcelName }}
                - from {{ $incoming->address->address }}
            </td>


            @if($incoming->ship_status == 3)

            <td><a href="/parcel/incoming/{{ $incoming->id }}"><button class="btn btn-info">Set Received</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Incoming Parcels</td>
        </tr>

        @endif
    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Received Incoming</td>
        </tr>

        @if($parcelsReceived->count())
        @foreach($parcelsReceived->with('parcel', 'address', 'address_receiver')->get() as $received)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $received->parcel->parcelWeight }} (Kgs) -
                {{ $received->parcel->parcelName }}
                - to {{ $received->address_receiver->address }}
            </td>


            @if($received->ship_status == 4)

            <td><a href="/parcel/details/{{ $received->id }}"><button class="btn btn-info">View Details</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Received Parcels</td>
        </tr>

        @endif
    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Shipped and Received by other agents</td>
        </tr>

        @if($parcelsReceivedOther->count())
        @foreach($parcelsReceivedOther->with('parcel', 'address')->get() as $receivedOther)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $receivedOther->parcel->parcelWeight }} (Kgs) -
                {{ $receivedOther->parcel->parcelName }}
                - from {{ $receivedOther->address->address }}
            </td>


            @if($receivedOther->ship_status == 4)

            <td><a href="/parcel/details/{{ $receivedOther->id }}"><button class="btn btn-info">View Details</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Parcels received by other agents</td>
        </tr>

        @endif
    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Received and Delivered To Citizens by you</td>
        </tr>

        @if($parcelsDeliveredToCitizen->count())
        @foreach($parcelsDeliveredToCitizen->with('parcel', 'address')->get() as $deliveredToCitizen)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $deliveredToCitizen->parcel->parcelWeight }} (Kgs) -
                {{ $deliveredToCitizen->parcel->parcelName }}
                - from {{ $deliveredToCitizen->address->address }}
            </td>


            @if($deliveredToCitizen->ship_status == 5)

            <td><a href="/parcel/details/{{ $deliveredToCitizen->id }}"><button class="btn btn-info">View Details</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No parcels have been delivered to citizens</td>
        </tr>

        @endif
    </table>


    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Shipped and Received by other agents and delivered to citizens</td>
        </tr>

        @if($parcelsDeliveredOther->count())
        @foreach($parcelsDeliveredOther->with('parcel', 'address')->get() as $deliveredOther)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $deliveredOther->parcel->parcelWeight }} (Kgs) -
                {{ $deliveredOther->parcel->parcelName }}
                - from {{ $deliveredOther->address->address }}
            </td>


            @if($deliveredOther->ship_status == 5)

            <td><a href="/parcel/details/{{ $deliveredOther->id }}"><button class="btn btn-info">View Details</button></a></td>

            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Parcels received by other agents</td>
        </tr>

        @endif
    </table>







</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>