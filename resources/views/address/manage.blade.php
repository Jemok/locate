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

<h3 class="lead text-center">Manage your addresses here:</h3>
<a href="/home" class="col-md-offset-1"><button class="btn btn-default">Home</button></a>

<a href="/client/citizen"><button class="btn btn-default">Citizen Dashboard</button></a>

<a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-default">Logout</button></a>

<div class="col-md-offset-3 col-md-7 register">

<h3 class="text-center">Search for an agent</h3>

<form method="post" action="/agent/search" class="form-horizontal">


    <input type="search" name="search" class="form-control" placeholder="search for an agent">

</form>

    @if(isset($results->agentName))

    <div class="container col-md-10 col-md-offset-1" style="padding-top: 10px;">

        <h3 class="text-center text-info">{{ $results->agentName }} Addresses</h3>

        @if($addresses->count())

        <table class="table table-bordered">

            <tr>
                <td class="success text-info">Address</td>
            </tr>



            @foreach($addresses->with('usage')->get() as $address)

            <tr>

                    <td class="success text-info">{{ $address->address }}</td>

                    @if(!isset($address->usage->user_id))

                    <td class="success"><a href="/address/use/{{$address->id}}/{{\Auth::user()->id}}"<button class="btn btn-info">Use</button></td>

                    @else

                    @if(isset($address->usage->user_id) AND isset($address->usage->usageActivity))
                    @if($address->usage->user_id == \Auth::user()->id AND $address->usage->usageActivity == 1 )

                    <td class="success"><a href="/address/un-use/{{$address->id}}/{{\Auth::user()->id}}"><button class="btn btn-danger">Un - use</button></a></td>

                    @else

                    <td class="success"><a href="/address/use/{{$address->id}}/{{\Auth::user()->id}}"<button class="btn btn-info">Use</button></td>

                    @endif
                    @endif

                    @endif




            </tr>

            @endforeach
        </table>

        @else

        <h6>No addresses yet -- Assign yourself to this agent and use them as your pick up point.</h6>

        @endif

    </div>

    @else

    @endif




</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>