<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link  type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <style>
            html, body {
                height: 100%;
                color:#000000;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background-color: #ffffff;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .text{

                color: red;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .track
            {
                font-size: 50px;
                border: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3" style="padding-bottom: 50px;">
                <form method="get" action="/parcel/track/" class="form-horizontal">

                <input style="color: red; font-weight: bolder;" type="search" name="search" class="form-control" placeholder="enter your track code">

                </form>

            </div>

            @if(isset($trackDetails->ship_status))



            <div class="col-md-6 col-md-offset-3" style="background-color: palegreen;">

                    @if($trackDetails->ship_status == 1)


                        <h3 class="text-center">To be picked</h3>


                    @endif

                    @if($trackDetails->ship_status == 2)

                         <h3 class="text-center">Picked by your agent</h3>

                    @endif

                    @if($trackDetails->ship_status == 3)

                    <tr>
                        <td>
                        <h3 class="text-center" style="font-size: 50px;">On transit to receiver agent</h3>
                        </td>
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
            </div>

                <div class="col-md-offset-3 col-md-6" style="padding-top: 30px;">

                    <a href="/"><button class="btn btn-default text">Home</button></a>

                    <a href="/auth/login"><button class="btn btn-default text">Login</button></a>

                    <a href="/auth/register"><button class="btn btn-default text">Register</button></a>

                </div>

                <div class="content">

                    <div class="title">Locate.com</div>

                    Your logistics partner....
                </div>

            @else

            <div class="col-md-offset-3 col-md-6">

                <a href="/auth/login"><button class="btn btn-default text">Login</button></a>
                <a href="/auth/register"><button class="btn btn-default text">Register</button></a>

            </div>

            <div class="content">

                <div class="title">Locate.com</div>

                Your logistics partner....
            </div>

            @endif
        </div>
    </body>
</html>
