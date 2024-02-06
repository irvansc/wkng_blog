<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link rel="shortcut icon" href="{{\App\Models\Setting::find(1)->blog_favicon}}" type="image/x-icon">

    <link href="./back/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="./back/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="./back/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="./back/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    @stack('stylesheets')
    @livewireStyles
    <style>
        .swal2-popup {
            font-size: .85rem;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('back/dist/libs/ijabo/ijabo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.css') }}">
    <link rel="stylesheet" href="/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/jquery-ui-1.13.2/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/jquery-ui-1.13.2/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="/amsify/amsify.suggestags.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="./back/dist/css/demo.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('back.layouts.inc.header')
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                @yield('pageHeader')
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @include('back.layouts.inc.footer')
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('back/dist/libs/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijabo/ijabo.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>
    <script src="/jquery-ui-1.13.2/jquery-ui.min.js"></script>
    <!-- Tabler Core -->
    <script src="/amsify/jquery.amsify.suggestags.js"></script>
    <script src="./back/dist/js/tabler.min.js"></script>
    @stack('scripts')
    @livewireScripts
    <script src="./back/dist/js/demo.min.js"></script>
    <script>
           $('input[name="post_tags"]').amsifySuggestags({
            type: 'amsify'
        });

        window.addEventListener('showToastr', function(event) {
            toastr.remove();
            if (event.detail.type === 'info') {
                toastr.info(event.detail.message);
            } else if (event.detail.type === 'success') {
                toastr.success(event.detail.message);
            } else if (event.detail.type === 'warning') {
                toastr.warning(event.detail.message);
            } else if (event.detail.type === 'error') {
                toastr.error(event.detail.message);
            } else {
                return false;
            }


        });

    </script>
</body>

</html>
