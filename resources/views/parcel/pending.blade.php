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


    <div class="col-md-5" style="padding-top: 20px;">

        <table class="table table-bordered">

            <tr>
                <td class="success text-info text-center">Step</td>
            </tr>


            @if($parcelStep == 1)
            <tr>
                <td class="text-info" style="font-size: large;">Details</td>



                <td><button class="btn btn-success">Completed</button></td>



                <td><a href="/continue/details/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>


            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Receiver</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/receiver-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Delivery</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/delivery-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Quotation</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/quotation-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>

            @endif

            @if($parcelStep == 2)
            <tr>
                <td class="text-info" style="font-size: large;">Details</td>



                <td><button class="btn btn-success">Completed</button></td>



                <td><a href="/continue/details/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>



            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Receiver</td>



                <td><button class="btn btn-success">Completed</button></td>


                <td><a href="/continue/receiver/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>



            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Delivery</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/delivery-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Quotation</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/delivery-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>

            @endif

            @if($parcelStep == 3)
            <tr>
                <td class="text-info" style="font-size: large;">Details</td>



                <td><button class="btn btn-success">Completed</button></td>



                <td><a href="/continue/details/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>



            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Receiver</td>



                <td><button class="btn btn-success">Completed</button></td>



                <td><a href="/continue/receiver/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>



            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Delivery</td>



                <td><button class="btn btn-success">Completed</button></td>



                <td><a href="/continue/delivery/edit/{{ $parcelId }}"><button class="btn btn-danger">Edit</button></a></td>



            </tr>

            <tr>
                <td class="text-info" style="font-size: large;">Quotation</td>



                <td><button class="btn btn-warning">Pending...</button></td>


                <td><a href="/parcel/quotation-finish/{{ $parcelId }}"><button class="btn btn-danger">Finish</button></a></td>


            </tr>


            @endif


        </table>


    </div>

</div>


</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(300);
</script>
