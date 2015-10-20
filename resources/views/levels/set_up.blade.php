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
    <div class="text-center"><button class="btn btn-default"><span style="color: red;">Remaining ({{ $numberOfLevels }})</span></button></div>
</div>

<div class="col-md-offset-3 col-md-5 register">

    @if(!($numberOfLevels == $levelsCount))

    <h3 class="text-center text-info"> Add Level</h3>

    <form method="POST" action="/building-level/register/{{ $id }}" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="form-group {{ $errors->has('levelName') ? 'has-error' : ''}}">

            <select name="levelName" class="form-control">

                <option value="" disabled selected>Select a level </option>

                @if($levels->count())

                @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->levelName }}</option>
                @endforeach

                @else

                <option value="" disabled selected>No listed categories here</option>

                @endif

            </select>

            {!! $errors->first('levelName', '<span class="help-block">:message</span>' ) !!}

        </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Add Level</button>
            </div>

     </form>

    @else

    <h3>Levels addition is closed</h3>

    <p>Open with how Many?? Levels</p>

    <form class="form-horizontal" action="/building-level/revive/{{ $id }}" method="post">

        <select name="howManyLevels" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <br>

        <div class="text-center">
            <button class="btn btn-info" type="submit">Open Levels Addition</button>
        </div>

    </form>


    @endif
</div>


<div class="container col-md-7 col-md-offset-2" style="padding-top: 10px;">

    <h3 class="text-center text-info">Existing Levels</h3>

    @if($levelNames->count())

    <table class="table table-bordered">

        <tr>
            <td class="success text-info">Id</td>
            <td class="success text-info text-center">Name</td>
        </tr>



        @foreach($levelNames as $level)

        <tr>

            <td class="success text-info">{{ $level->id }}</td>
            <td class="success text-info">{{ $level->levelName }}</td>
            <td class="success"><a href=""><button class="btn btn-info">Edit</button> </a></td>
            <td class="success"><a href="/location/set-up/{{ $level->id }}"><button class="btn btn-info">Add locations</button></a></td>
            <td class="success"><a href="/location/address/{{ $level->id }}"><button class="btn btn-info">View locations</button></a></td>
            <td class="success"><a href=""><button class="btn btn-danger">Delete</button></a></td>



        </tr>

        @endforeach
    </table>

    @else

    <h3>No levels</h3>

    @endif

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>