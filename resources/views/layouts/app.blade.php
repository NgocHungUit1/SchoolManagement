<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>School Management</title>
    <link rel="shortcut icon" href="/./assets/img/favicon.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="/./assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/./assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="/./assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="/./assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/./assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/./assets/css/style.css">
    <link rel="stylesheet" href="/./assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
        .highlighted {
            background-color: yellow;
        }
    </style>



</head>

<body>

    <div class="main-wrapper">
        @include('layouts.header')
        @yield('content')
    </div>

    <script src="/./assets/js/jquery-3.6.0.min.js"></script>
    <script src="/./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/./assets/js/feather.min.js"></script>
    <script src="/./assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/./assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="/./assets/plugins/apexchart/chart-data.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="/./assets/plugins/datatables/datatables.min.js"></script>
    <script src="/./assets/js/script.js"></script>
    @stack('js')
</body>

</html>
