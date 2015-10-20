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

<a href="/street/add/"><button class="btn btn-info">Add Street</button></a>


<a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-warning">Logout</button></a>
</div>
<body>

    <div class="container col-md-7 col-md-offset-2" style="padding-top: 10px;">

        <h3 class="text-center text-info">Streets</h3>

        @if($streets->count())

        <table class="table table-bordered">

            <tr>
                <td class="success text-info">Id</td>
                <td class="success text-info">Name</td>
                <td class="success text-info">Key</td>
                <td class="success text-info">Description</td>
            </tr>



                @foreach($streets as $street)

                <tr>
                    <td class="success text-info">{{ $street->id }}</td>
                    <td class="success text-info">{{ $street->streetKeyName }}</td>
                    <td class="success text-info">{{ $street->streetKeyCode }}</td>
                    <td class="success text-info">{{ $street->streetDescription }}</td>
                    <td class="success"><a href="/street/edit/{{ $street->id }}"><button class="btn btn-info">Edit</button> </a></td>
                    <td class="success"><a href="/street/delete/{{ $street->id }}"><button class="btn btn-danger">Delete</button></a></td>


                        @if($street->buildingStatus == 0)

                         <td class="success"><a href="/street-building/set-up/{{ $street->id }}"><button class="btn btn-info">Add Buildings</button></a></td>

                        @elseif($street->buildingStatus == 1)

                        <td class="success"><a href="/street-building/set-up/{{ $street->id }}"><button class="btn btn-info">Add Buildings</button></a></td>
                        <td class="success"><a href="/street-building/close/{{ $street->id }}"><button class="btn btn-warning">Close Street</button></a></td>

                        @elseif($street->buildingStatus == 2)

                        <td  class="success">
                            <form method="post" action="/street-building/open/{{ $street->id }}">
                                <button type="submit" class="btn btn-success">Open street</button>
                            </form>
                        </td>
                        @endif

                        <td class="success"><a href="/street/buildings/{{ $street->id }}"><button class="btn btn-success">Buildings ({{ $street->buildingCount }})</button></a></td>

                </tr>

                @endforeach
            </table>

            @else

            <h3>You are not managing any streets</h3>

            @endif

    </div>
</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>