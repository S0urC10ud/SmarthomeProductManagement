<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPM - @yield('title','')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <style>
        .nav-link {
            cursor: pointer;
            color: #d4d4d4 !important;
            font-weight: normal;
            transition-duration: .5s;
        }

        .nav-link:hover {
            color: white !important;
            text-decoration: underline !important;
            transition-duration: .6s;
        }

        #footer {
            position: relative;
            margin-top: -3em;
            height: 3em;
            clear: both;
            line-height: 3em;
            vertical-align: center;
        }

        #wrap {
            min-height: 100vh;
        }

        #main {
            overflow: auto;
            padding-bottom: 5em;
        }

        /*Opera Fix*/
        body:before { /* thanks to Maleika (Kohoutec)*/
            content: "";
            height: 100%;
            float: left;
            width: 0;
            margin-top: -32767px; /* thank you Erik J - negate effect of float*/
        }

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    @section('customStyles')
    @show
</head>
<body>


<div id="wrap">
    <div id="main">
        @section('header')
            <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
                <img
                    src="/images/microcontroller.png"
                    alt="iot image" style="height: 3rem; margin-right: 1em;">
                <a class="navbar-brand float-left" style="color: white;">Smarthome Product Management</a>

                <ul class="navbar-nav navbar-right ml-auto">
                    <li class="nav-item" id="dashboardSelectionSpan"><a class="nav-link">Dashboard</a></li>
                    <li class="nav-item" id="productsAndServicesSelectionSpan"><a class="nav-link">Products and Services</a></li>
                    <li class="nav-item" id="orderSelectionSpan"><a class="nav-link">Orders</a></li>
                </ul>
            </nav>@show

        <div class="mainContainer" style="overflow: auto">
            @section('content')
            @show
        </div>
    </div>
</div>

<div id="footer" class="font-small bg-dark navbar-fixed-bottom">
    <div class="text-center" style="color:#afafaf;">{{isset($company) ? $company->name : "Your-Company-Name"}} |
        {{Carbon\Carbon::now()->format('d.m.Y')}} |
        <a style="text-decoration: underline; color: #afafaf;" href="{{route('imprint')}}">Legal Notice (Imprint)</a></div>
</div>

</body>
</html>