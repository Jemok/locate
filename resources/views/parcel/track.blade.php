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
    <a href="/client/citizen/"><button class="btn btn-info">Citizen Dashboard</button></a>


    <a href="/auth/logout" class="col-md-offset-6"><button class="btn btn-warning">Logout</button></a>
</div>
<body>

<div class="container col-md-7 col-md-offset-2" style="padding-top: 50px;">


    @if(isset($trackDetails->ship_status))

    <table class="table table-bordered" style="padding-top: 30px;">

        @if($trackDetails->ship_status == 1)

        <h5 class="text-center">Status</h5>

        <tr>
            <td class="success text-info"><h3>To be picked</h3></td>
        </tr>

        @endif

        @if($trackDetails->ship_status == 2)

        <h5 class="text-center">Status</h5>


        <tr>
            <td class="success text-info"><h3>Picked by your agent</h3></td>
        </tr>

        @endif

        @if($trackDetails->ship_status == 3)

        <h5 class="text-center">Status</h5>



        <tr>
            <td class="success text-info text-center"><h3>On transit to receiver agent</h3></td>
        </tr>

        @endif

        @if($trackDetails->ship_status == 4)

        <h5 class="text-center">Status</h5>



        <tr>
            <td class="success text-info text-center"><h3>Received by receiver agent</h3></td>
        </tr>

        @endif

        @if($trackDetails->ship_status == 5)

        <h5 class="text-center">Status</h5>



        <tr>
            <td class="success text-info text-center"><h3>Delivered Successfully</h3></td>
        </tr>

        @endif
    </table>

    @else

    <h3>Parcel cannot be tracked</h3>

    @endif

</div>
</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>