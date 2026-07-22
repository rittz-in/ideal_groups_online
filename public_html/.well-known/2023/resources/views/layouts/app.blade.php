<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('customer_name') - @yield('brand_name')</title>
    <title>Ideal Groups</title>
    <meta name="theme-color" content="#ffffff">
    
<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

    <link href="{{ asset('/assets/fontawesom/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('/assets/fontawesom/css/brands.css') }}" rel="stylesheet">
  
  <link href="{{ asset('/assets/fontawesom/css/solid.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- toust message --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- end toust message --}}

</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar" style="background-color: black;">
        <div class="sidebar-brand d-none d-md-flex">
            @if(Auth::check() && Auth::user()->role == 1)
                        <img src="{{ asset('assets/logo.png') }}" class="card-img-top mt-3" alt="Service 6" style="width: 60px;">
            @else
                @if ($item)
                    @if ($item->logo)
                        <img src="{{ Storage::url($item->logo) }}" class="card-img-top" alt="Service 6" style="height: auto; max-width: 120px;">
                    @elseif ($item->BrandName)
                        {{ $item->BrandName }}
                    @else
                        {{ $item->username }}
                    @endif
                @else
                    <!-- Handle the case where $item is null -->
                @endif
            @endif
        </div>
        
    
        @include('layouts.navigation')
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <a class="header-brand d-md-none" href="#">
                    @if ($item)
                @if ($item->logo)
                    <img src="{{ Storage::url($item->logo) }}" class="card-img-top" alt="Service 6">
                @elseif ($item->BrandName)
                    {{ $item->BrandName }}
                @else
                    {{ $item->username }}
                @endif
            @endif
                </a>
                <ul class="header-nav d-none d-md-flex">
                    @if(Auth::check() && Auth::user()->role == 0)
                         <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
                    @endif
                    @if(Auth::check() && Auth::user()->role == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ route('super-admin.index') }}">Dashboard</a></li>
                    @endif
                </ul>
                @if(Auth::check() && Auth::user()->role == 0)
                <a class="ViewSite" href="{{ route('website_url', $userData->card_no) }}" target="_blank">
                    <button type="Button" class="btn btn-sm ViewSite ms-3">View Site
                </a>
                @endif
                </button>
                <ul class="header-nav ms-auto">

                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            
                        </div> --}}
                    </li>
                </ul>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div>&copy; All Rights Reserved | 2023 Ideal Groups. </div>
            <div class="ms-auto">Powered by Ideal Groups
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>
        $('.click-off').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>
    <script>
        $('.click-service').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>
    
    <script>
        $('.videolink_delete ').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>
    <script>
        $('.click-payment ').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>

<script>
    $('.click-contact ').click(function() { 
        if (!confirm('Are you sure?')) return false;
        var btn = this;
        setTimeout(function() {
            $(btn).attr('disabled', 'disabled');
        }, 1);
        return true;
    });
</script>
    
       <script>
        $('.click-testimonials').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>

    <script>
        $('.inquiry-delete').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>
    <script>
        $('.remove_Banner_image').click(function() { 
            if (!confirm('Are you sure?')) return false;
            var btn = this;
            setTimeout(function() {
                $(btn).attr('disabled', 'disabled');
            }, 1);
            return true;
        });
    </script>
    

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get all delete buttons with the "delete-btn" class
        const deleteButtons = document.querySelectorAll(".delete-btn");

        // Add a click event listener to each delete button
        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function (e) {
                // Prevent the default form submission
                e.preventDefault();

                // Get the confirmation message from the "data-confirm" attribute
                const confirmationMessage = button.getAttribute("data-confirm");

                // Show a confirmation dialog
                const isConfirmed = window.confirm(confirmationMessage);

                // If the user confirms, submit the form
                if (isConfirmed) {
                    const form = button.closest("form");
                    form.submit();
                }
            });
        });
    });
</script>


<script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>