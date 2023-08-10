<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                @include('doctor.partials.sidebar')
            </div>
            <div class="col-10">
                @include('doctor.partials.navbar')
                <main class="mt-3">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
        });
    </script>

    <script>
        window.addEventListener('created', event => {
            toastr.success(event.detail.message, 'Success');
            //$("#exampleModal").modal('show');
        });

         window.addEventListener('file_deleted', event => {
            $(".mainModal").modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            toastr.success(event.detail.message, 'Success');
            //$("#exampleModal").modal('show');
        });

        window.addEventListener('delete_confirm', event => {
            $("#deleteConfirm").modal('show');
        });

        window.addEventListener('hide_delete_confirm_modal', event => {
            $("#deleteConfirm").modal('hide');
        });
    </script>
    @livewireScripts
</body>
</html>