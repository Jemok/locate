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

<h3 class="lead text-center">Client-Citizen page:: Manage your citizen status here:</h3>
<a href="/home" class="col-md-offset-1"><button class="btn btn-default">Home</button></a>
<a href="/address/manage/"><button class="btn btn-default">Manage Addresses</button></a>
<a href="/parcel/send/"><button class="btn btn-default">Send Parcel</button></a>


<a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-default">Logout</button></a>

<div class="container">


        <div class="col-md-offset-3 col-md-4 register">



            @if((\Auth::user()->clientCitizen) == 1)

            <h3 class="text-center">Citizen Details..................</h3>

            {!! Form::model($citizen, ['url' => '/citizen/update/'.$citizen->id, 'method' => 'PATCH', 'class' => 'form-horizontal'])!!}

                    {!! csrf_field() !!}

                <div class="text-center">National ID No:</div>
                <div class="form-group {{ $errors->has('nationalId') ? 'has-error' : ''}}">
                    {!! Form::text('nationalId', null, ['class' => 'form-control', 'id' => 'nationalId'])!!}
                    {!! $errors->first('nationalId', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">First Name:</div>
                <div class="form-group {{ $errors->has('firstName') ? 'has-error' : ''}}"">
                    {!! Form::text('firstName', null, ['class' => 'form-control', 'id' => 'firstName'])!!}
                    {!! $errors->first('firstName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Second Name:</div>
                <div class="form-group {{ $errors->has('secondName') ? 'has-error' : ''}}"">
                    {!! Form::text('secondName', null, ['class' => 'form-control', 'id' => 'secondName'])!!}
                    {!! $errors->first('secondName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Third Name:</div>
                <div class="form-group {{ $errors->has('thirdName') ? 'has-error' : ''}}"">
                     {!! Form::text('thirdName', null, ['class' => 'form-control', 'id' => 'thirdName' ])!!}
                     {!! $errors->first('thirdName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Date of Birth:</div>
                <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : ''}}"">
                    {!! Form::text('dateOfBirth', null, ['class' => 'form-control', 'id' => 'dateOfBirth'])!!}
                    {!! $errors->first('dateOfBirth', '<span class="help-block">:message</span>' ) !!}
                </div>


                <div class="text-center">Mobile Number:</div>
                <div class="form-group {{ $errors->has('mobileNumber') ? 'has-error' : ''}}"">
                     {!! Form::text('mobileNumber', null, ['class' => 'form-control', 'id' => 'mobileNUmber'])!!}
                     {!! $errors->first('mobileNUmber', '<span class="help-block">:message</span>' ) !!}
                </div>


                <div class="text-center">Other Mobile Number:</div>
                <div class="form-group {{ $errors->has('otherMobileNUmber') ? 'has-error' : ''}}"">
                    {!! Form::text('otherMobileNumber', null, ['class' => 'form-control', 'id' => 'otherMobileNumber'])!!}
                    {!! $errors->first('otherMobileNumber', '<span class="help-block">:message</span>' ) !!}
                </div>



                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            {!! Form::close()!!}

            @else

            <h3 class="text-center">Citizen Registration..................</h3>

            <form method="POST" action="/citizen/register" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="text-center">National ID No:</div>
                <div class="form-group {{ $errors->has('nationalId') ? 'has-error' : ''}}">
                    <input type="text" name="nationalId" class="form-control">
                    {!! $errors->first('nationalId', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">First Name:</div>
                <div class="form-group {{ $errors->has('firstName') ? 'has-error' : ''}}"">
                <input type="text" name="firstName"  class="form-control">
                {!! $errors->first('firstName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Second Name:</div>
                <div class="form-group {{ $errors->has('secondName') ? 'has-error' : ''}}"">
                <input type="text" name="secondName" class="form-control">
                {!! $errors->first('secondName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Third Name:</div>
                <div class="form-group {{ $errors->has('thirdName') ? 'has-error' : ''}}"">
                <input type="text" name="thirdName" class="form-control">
                {!! $errors->first('thirdName', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="text-center">Date of Birth:</div>
                <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : ''}}"">
                <input type="text" name="dateOfBirth" class="form-control">
                {!! $errors->first('dateOfBirth', '<span class="help-block">:message</span>' ) !!}
                </div>


                <div class="text-center">Mobile Number:</div>
                <div class="form-group {{ $errors->has('mobileNumber') ? 'has-error' : ''}}"">
                <input type="text" name="mobileNumber"  class="form-control">
                {!! $errors->first('mobileNUmber', '<span class="help-block">:message</span>' ) !!}
                </div>


                <div class="text-center">Other Mobile Number:</div>
                <div class="form-group {{ $errors->has('otherMobileNUmber') ? 'has-error' : ''}}"">
                <input type="text" name="otherMobileNumber"  class="form-control">
                {!! $errors->first('otherMobileNumber', '<span class="help-block">:message</span>' ) !!}
                </div>



                <div class="text-center">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>

            @endif

        </div>


        <div class="col-md-5" style="padding-top: 15px;">

            <table class="table table-bordered">

                <tr>
                    <td class="success text-info text-center">Addresses</td>
                </tr>



                @if($uses->count())
                    @foreach($uses->with('address')->get() as $usage)

                    <tr>
                        <td class="text-info" style="font-size: small;">{{ $usage->address->address }}</td>

                        @if(($usage->usageActivity) == 1)

                            <td><button class="btn btn-success">Active</button></td>

                        @else

                            <td><a href="/address/usage-activate/{{ $usage->id }}"><button class="btn btn-danger">Activate</button></a></td>

                        @endif

                    </tr>

                    @endforeach

                @else

                    <tr>
                        <td><a href="/address/manage/"> Locate yourself??</a></td>
                    </tr>
                @endif
            </table>


        </div>


<div class="col-md-5" style="padding-top: 15px;">

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Pending Parcels</td>
        </tr>



        @if($parcelsPending->count())
            @foreach($parcelsPending as $pending)

            <tr>
                <td class="text-info" style="font-size: small;">
                    {{ $pending->parcelName }} - {{ $pending->parcelWeight }} (kg)
                </td>


                <td><a href="/parcel/continue/{{ $pending->id }}/"><button class="btn btn-success">Continue</button></a></td>
                <td><button class="btn btn-danger">Remove</button></td>

            </tr>

            @endforeach
        @else

        <tr>
            <td>No pending parcels</td>
        </tr>

        @endif

    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Sent Parcels</td>
        </tr>



        @if($sentParcels->count())
        @foreach($sentParcels->with('track.parcel.receiver.user.citizen','quotation')->get() as $sent)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $sent->parcelName }} - {{ $sent->parcelWeight }} (kg) -
                {{ $sent->quotation->quotationPrice }} - {{ $sent->quotation->trackCode }}

                to - {{$sent->track->parcel->receiver->emailReceiver }}

            </td>

            <td><a href="/parcel/track/{{ $sent->id }}"<button class="btn btn-info">Track Parcel</button></td>

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Sent parcels</td>
        </tr>

        @endif

    </table>

    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Incoming Parcels</td>
        </tr>


        @if($incomingParcels->count())
        @foreach($incomingParcels->with('parcel.user.citizen')->get() as $incoming)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $incoming->parcel->parcelName }} - {{ $incoming->parcel->parcelWeight }} (kg) -

                from - {{$incoming->parcel->user->citizen->firstName }}  {{$incoming->parcel->user->citizen->secondName }}

            </td>

            @if($incoming->ship_status < 5)
            <td><a href="/parcel/track/{{ $incoming->parcel->id }}"<button class="btn btn-info">Track Parcel</button></td>
            @endif

            @if($incoming->ship_status == 4)
            <td><a href="/parcel/set-delivered/{{ $incoming->id }}"<button class="btn btn-info">Set Delivered</button></td>
            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Incoming parcels</td>
        </tr>

        @endif

    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Parcels Delivered to you</td>
        </tr>


        @if($deliveredParcels->count())
        @foreach($deliveredParcels->with('parcel.user.citizen')->get() as $delivered)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $delivered->parcel->parcelName }} - {{ $delivered->parcel->parcelWeight }} (kg) -

                from - {{$delivered->parcel->user->citizen->firstName }}  {{$delivered->parcel->user->citizen->secondName }}

            </td>

            @if($delivered->ship_status == 5)
            <td><a href="/parcel/track/{{ $delivered->parcel->id }}"<button class="btn btn-info">View Details</button></td>
            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Delivered parcels</td>
        </tr>

        @endif

    </table>

    <table class="table table-bordered">

        <tr>
            <td class="success text-info text-center">Parcels Delivered from you</td>
        </tr>


        @if($deliveredParcelsByYou->count())
        @foreach($deliveredParcelsByYou->with('parcel.user.citizen')->get() as $deliveredByYou)

        <tr>
            <td class="text-info" style="font-size: small;">
                {{ $deliveredByYou->parcel->parcelName }} - {{ $deliveredByYou->parcel->parcelWeight }} (kg) -

                from - {{$deliveredByYou->parcel->user->citizen->firstName }}  {{$deliveredByYou->parcel->user->citizen->secondName }}

            </td>

            @if($deliveredByYou->ship_status == 5)
            <td><a href="/parcel/track/{{ $delivered->parcel->id }}"<button class="btn btn-info">View Details</button></td>
            @endif

        </tr>

        @endforeach
        @else

        <tr>
            <td>No Delivered parcels</td>
        </tr>

        @endif

    </table>



</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>