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
</div >

<div style="padding-top: 50px;">
    <a href="/home" class="col-md-offset-1"><button class="btn btn-info">Home</button></a>
    <a href="/client/agent/"><button class="btn btn-info">Agent Dashboard</button></a>
    <a href="/street/manage/"><button class="btn btn-info">Streets</button></a>

    <a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-warning">Logout</button></a>
</div>
<body>

<div class="container col-md-7 col-md-offset-2" style="padding-top: 10px;">

    <h3 class="text-center text-info">{{ $streetName }}  - Buildings</h3>

    @if($buildings->count())

    <table class="table table-bordered">

        <tr>
            <td class="success text-info">Id</td>
            <td class="success text-info">Key</td>
            <td class="success text-info">Name</td>
        </tr>
        @foreach($buildings as $building)

        <tr>
            <td class="success text-info">{{ $building->id }}</td>
            <td class="success text-info">{{ $building->buildingKeyCode }}</td>
            <td class="success text-info">{{ $building->buildingKeyName }}</td>
            <td class="success"><a href="/building/edit/{{ $building->id }}"><button class="btn btn-info">Edit</button> </a></td>
            <td class="success"><a href="/building/delete/{{ $building->id }}"><button class="btn btn-danger">Delete</button></a></td>
            <td class="success"><a href="/building-level/set-up/{{ $building->id }}"><button class="btn btn-success">{{ $building->numberOfLevels }} Levels to be added </button></a></td>
        </tr>

        @endforeach
    </table>

    @else

    <h3>There are no buildings on this streets</h3>

    @endif

</div>
</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>