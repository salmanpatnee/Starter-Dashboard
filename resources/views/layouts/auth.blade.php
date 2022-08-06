<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Content Wrapper -->

    <div class="container-center">
        <div class="panel panel-bd">
            <div class="panel-heading">

                <div class="view-header">
                    <div class="header-icon">
                        <i class="pe-7s-unlock"></i>
                    </div>
                    <div class="header-title">
                        <h3></h3><br>
                        <small>
                            <h3>@yield('title')</h3>
                        </small>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                @yield('content')
            </div>

        </div>
    </div>
</body>

</html>
