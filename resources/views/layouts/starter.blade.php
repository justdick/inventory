<!DOCTYPE html>
<html lang="en">

    @include('../includes/head')

    <body style="height: 100%;">
        <div class="main-wrapper" style=" min-height: 100%; ">
            <!-- Header -->
            @include('../includes/header')
            <!--Header End-->

            @if (Auth::User()->role == 'admin')
                @php
                    $pagewrapper = 'page-wrapper ';
                @endphp
                <!-- Sidebar -->
                @include('../includes/sidebar')
                <!-- Sidebar End -->
            @endif


            <!-- Content -->
            <div class="{{$pagewrapper ?? "mx-4 mt-5"}} bg-wrapper ">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
            <!-- Content End -->

        @include('../includes/scripts')
    </body>

</html>
