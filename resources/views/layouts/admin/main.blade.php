<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Bale Hinggil</title>

    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/table-datatable.css') }}">
    @vite(['resources/css/admin/main.css'])

    @stack('styles')
</head>
<body>
    <div id="app">
        @include('layouts.admin.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Patch HARUS inline sebelum app.js, tidak bisa di file eksternal --}}
    <script>
        window.ADMIN_UNREAD_COUNT_URL = '{{ route("admin.messages.unread-count") }}';
        window.ADMIN_MESSAGES_URL = '{{ route("admin.messages.index") }}';

        /* Patch Mazer bug: getBoundingClientRect on null
           app.js memanggil getBoundingClientRect langsung (bukan lewat setTimeout),
           jadi satu-satunya cara adalah patch Element.prototype sebelum app.js load */
        (function () {
            const _getBCR = Element.prototype.getBoundingClientRect;
            Element.prototype.getBoundingClientRect = function () {
                if (!this) return { top:0, left:0, bottom:0, right:0, width:0, height:0 };
                return _getBCR.apply(this, arguments);
            };

            /* Jaga-jaga: wrap juga querySelectorAll supaya null-check aman */
            const _init = window.setTimeout;
            window.setTimeout = function (fn, delay) {
                return _init(function () {
                    try { fn(); } catch (e) {
                        if (e instanceof TypeError && e.message.includes('getBoundingClientRect')) {
                            // bug Mazer, abaikan
                        } else { throw e; }
                    }
                }, delay);
            };
        })();
    </script>

    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>
    @stack('datatables-scripts')
    <script src="{{ asset('assets/js/chart.js') }}"></script>

    @vite(['resources/js/admin/main.js'])

    @stack('scripts')
</body>
</html>