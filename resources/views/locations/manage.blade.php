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

<div class="container col-md-7 col-md-offset-2" style="padding-top: 10px;">

    <h3 class="text-center text-info">Existing Locations</h3>

    @if($locations->count())

    <table class="table table-bordered">

        <tr>
            <td class="success text-info">Id</td>
            <td class="success text-info">Code</td>
            <td class="success text-info text-center">Name</td>
            <td class="success text-info text-center">Address</td>
        </tr>



        @foreach($locations->get() as $location)

        <tr>

            <td class="success text-info">{{ $location->id }}</td>
            <td class="success text-info">{{ $location->locationKeyCode }}</td>
            <td class="success text-info">{{ $location->locationKeyName }}</td>
            <td class="success text-info">{{ $location->address->address }}</td>
            <td class="success"><a href=""><button class="btn btn-info">Edit</button> </a></td>
            <td class="success"><a href=""><button class="btn btn-danger">Delete</button></a></td>



        </tr>

        @endforeach
    </table>

    @else

    <h3>No locations</h3>

    @endif

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>