<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- meta tag description --}}
    <meta name="description" content="Jasaklan, jasa layanan monetisasi untuk berbagai platform media sosial youtube, halaman facebook, instagram, tiktok, twitter, blog/website, linkedin, pinterest, tumblr, bigo live, video snack, marketplace dan lain-lain.">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo-icon.ico')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    @livewireStyles
</head>

<body class="font-sans antialiased">
    @include('layouts.navigation')
    <div class="bg-white">
        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header ??''}}
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-8">
            {{ $slot }}
        </main>
    </div>
    <x-footer />
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('scripts')
    <script>
        $(document).ready(function(value) {
            window.livewire.on('showAlert', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.msg,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
                if (data?.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect
                    }, 2000)
                }
            });
            
            window.livewire.on('showAlertError', (data) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msg,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
            });

            window.livewire.on('openAdsUrl', (data) => {
                window.href = data
                setTimeout(() => {
                    window.open('/viewers/iklan-view', '_blank');
                }, 2000);
            });
        })
    </script>
    <script>
        const modalElement = document.getElementById("konfirmasi");
            const modal = new Modal(modalElement);

            @if(session('content'))
                modal.show();
            @endif

            const hideModalConfirmation = () => {
                modal.hide();
            }

    </script>
    @livewireScripts
</body>

</html>