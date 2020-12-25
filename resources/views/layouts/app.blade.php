<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>SPM - @yield('title','')</title>


    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.24/dist/shoelace/shoelace.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

        /*Opera Footer Fix*/
        body:before { /* thanks to Maleika (Kohoutec)*/
            content: "";
            height: 100%;
            float: left;
            width: 0;
            margin-top: -32767px; /* thank you Erik J - negate effect of float*/
        }

        body {
            background-color: #EFEFEF !important;
        }

        .short-title {
            display: none;
        }

        @media (max-width: 500px) {
            .short-title {
                display: inline-block;
            }

            .full-title {
                display: none;
            }
        }
    </style>
    @section('customStyles')
    @show

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/js/deleteEntry.js"></script>
    <script type="module"
            src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.24/dist/shoelace/shoelace.esm.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    @section('customScripts')
    @show

</head>
<body>


<div id="wrap">
    <div id="main">
        @section('header')
            <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
                <a class="navbar-brand float-left" style="color: white;" href="{{route('dashboard')}}">
                    <img
                        src="/images/microcontroller.png"
                        alt="iot image" style="height: 3rem; margin-right: 1em;">

                    <span class="full-title">Smarthome Product Management</span>
                    <span class="short-title">SPM</span>


                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" id="dashboardSelectionSpan">
                            <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="nav-item" id="productsAndServicesSelectionSpan">
                            <a class="nav-link" href="{{route('product.index')}}">Products and
                                Services</a>
                        </li>
                        <li class="nav-item" id="orderSelectionSpan">
                            <a class="nav-link" href="{{route('order.index')}}">Orders</a>
                        </li>
                    </ul>
                </div>
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
        <a style="text-decoration: underline; color: #afafaf;" href="{{route('imprint')}}">Legal Notice (Imprint)</a>
    </div>
</div>

</body>
</html>
