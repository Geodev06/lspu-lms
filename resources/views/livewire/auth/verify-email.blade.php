<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify</title>


    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />



    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>


    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>

    <link data-navigate-once href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" rel="stylesheet" integrity="sha384-e4/pU/7fdyaPKtXkqAgHNgoYAb2LNmChhpSuSp8o6saYtS2sP+JZsu8Wy/7mGV7w" crossorigin="anonymous">
    <link data-navigate-once href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" integrity="sha384-DJhypeLg79qWALC844KORuTtaJcH45J+36wNgzj4d1Kv1vt2PtRuV2eVmdkVmf/U" crossorigin="anonymous">
    <link data-navigate-once href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.min.css" rel="stylesheet" integrity="sha384-seyUnB//1QOFEqox9uI7YTLBgz9jBwFRqZvsEPFrTw6NAsFEo70nhBWsQfODqiYA" crossorigin="anonymous">
    <link data-navigate-once href="https://cdn.datatables.net/searchbuilder/1.8.2/css/searchBuilder.bootstrap5.min.css" rel="stylesheet" integrity="sha384-c+17EpI1t/ZAjBoElPoW3nsmP/5974nO3qiFjdyE/JLy0pDYToN1xM+cdrRNTcab" crossorigin="anonymous">
    <link data-navigate-once href="https://cdn.datatables.net/searchpanes/2.3.3/css/searchPanes.bootstrap5.min.css" rel="stylesheet" integrity="sha384-kCfL8qIiEo0PgaMnJvqVlxd797OkgozSx5pxn/uCJOY5d99ovqdqU545WcRTbo+m" crossorigin="anonymous">

    <script data-navigate-once src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha384-NXgwF8Kv9SSAr+jemKKcbvQsz+teULH/a5UNJvZc6kP47hZgl62M1vGnw6gHQhb1" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js" integrity="sha384-RZEqG156bBQSxYY9lwjUz/nKVkqYj/QNK9dEjjyJ/EVTO7ndWwk6ZWEkvaKdRm/U" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js" integrity="sha384-G85lmdZCo2WkHaZ8U1ZceHekzKcg37sFrs4St2+u/r2UtfvSDQmQrkMsEx4Cgv/W" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js" integrity="sha384-zlMvVlfnPFKXDpBlp4qbwVDBLGTxbedBY2ZetEqwXrfWm+DHPvVJ1ZX7xQIBn4bU" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.min.js" integrity="sha384-BdedgzbgcQH1hGtNWLD56fSa7LYUCzyRMuDzgr5+9etd1/W7eT0kHDrsADMmx60k" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js" integrity="sha384-v0wzF6NECWiQyIain/Wacl6wEYr6NDJRus6qpckumPIngNI9Zo0sDMon5lBh9Np1" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js" integrity="sha384-A6In5tKqlvPZKDpH+ei4A3A4TZrEsyvvN2Fe+oCB1IaQfGD5HNqDIxwjztNKSGDd" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js" integrity="sha384-hyp/YDWGBMFqg7pJuS+y+2VWJkwnOyX+oMN9fWcxINo2flqjC/SdNaHj8LIV4zKJ" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/searchbuilder/1.8.2/js/dataTables.searchBuilder.min.js" integrity="sha384-SZjRT2FoEIHY6x2Ja59fXuRxb9tFVTEq9iXTHLglPW1ZH8Uel5uyi/grp/MuR32Q" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/searchbuilder/1.8.2/js/searchBuilder.bootstrap5.min.js" integrity="sha384-9eFZ0WfV3F1WYwtSPlJAQyeKYNmJBE5j1YPuzvkMJM+iQFp2AhwUEBDu/TogLL5c" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/searchpanes/2.3.3/js/dataTables.searchPanes.min.js" integrity="sha384-sUuBv4oZPlATC6Uuta8hZSx3oiTAet53rbLe+vHVcTbupVepb13xKgdB4jYsm/oh" crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.datatables.net/searchpanes/2.3.3/js/searchPanes.bootstrap5.min.js" integrity="sha384-lSurcF2KnvB8sCKtogfFCwJO4ZENtGvi0S5C4v6t9qh4R46oqvc3CEzcm2L/YIVg" crossorigin="anonymous"></script>

    <script data-navigate-once src="{{ asset('js/app.js') }}"></script>

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <livewire:base.aside />
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <livewire:base.nav />

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="container-xxl">
                    <div class="row" style="height: 100vh;">
                        <div class="col-lg-4 mx-auto my-auto p-5 col-sm-9 col-md-6">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center mb-5">
                                <a href="/" class="app-brand-link gap-2">
                                    <img src="{{ asset('img/cert_lspu.png') }}" alt="" sizes="" srcset="" height="100">
                                </a>
                            </div>
                            <!-- /Logo -->
                            <h4 class="mb-2">Welcome to LMS!</h4>
                            <p class="mb-4">Please sign-in to your account and start learning.</p>

                            @if(session('success'))
                            <x-message-alert type="success" message="{{ session('success') }}" />
                            @endif

                            @if(session('error'))
                            <x-message-alert type="danger" message="{{ session('error') }}" />
                            @endif

                            <form id="formAuthentication" class="mb-3" action="index.html" method="POST">

                                @error('email')
                                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                @enderror
                                <div class="mb-3">
                                    <label for="email" class="form-label">Institutional Email</label>
                                    <input type="text" wire:model="email" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus="">
                                </div>
                                @error('password')
                                <label for="" class="form-label text-danger form-error">{{ $message }}</label>
                                @enderror
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                        <a href="auth-forgot-password-basic.html">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" wire:model="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model="remember" type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button
                                        class="btn btn-primary d-grid w-100"
                                        wire:click.prevent="submit"
                                        wire:loading.attr="disabled"
                                        wire:target="submit"
                                        type="submit">
                                        <span wire:loading.remove wire:target="submit">Sign In</span>
                                        <span wire:loading wire:target="submit">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Signing In ...
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <p class="text-center">
                                <span>New on our platform?</span>
                                <a href="{{ route('register') }}">
                                    <span>Create an account</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
    </div>

    <!-- Core JS -->
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script data-navigate-once src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/js/menu.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/dashboards-analytics.js') }}"></script>




</body>

</html>