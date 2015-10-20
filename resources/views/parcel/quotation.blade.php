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

    <h3 class="text-center text-info">Your Code and quotation is here</h3>

    <h5 class="text-center text-info">{{ $quotation }}</h5>

    <div class="col-md-12">
        <div class="text-center form-group">
            <a href="/parcel/send-new/"><button class="btn btn-success">Send Parcel</button></a>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>