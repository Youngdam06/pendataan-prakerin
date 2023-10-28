<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Cache-Control" content="no-store" />
<meta http-equiv="Pragma" content="no-cache" />
<link rel="icon" type="image/png" href="/assets/img/icon4.png">
<title>
    Pendataan Prakerin
</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
{{-- sidebar --}}

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

    <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" >
        <img src="/assets/img/icon4.png" class="navbar-brand-img h-100" alt="main_logo">
        @if (Auth::guard('admin')->check())
        <span class="font-weight-bold text-white mt-5">
            Hai, {{ Auth::guard('admin')->user()->nama }}
        </span>
        @elseif (Auth::guard('pembimbing')->check())
            <span class="font-weight-bold text-white mt-5">
                Hai, {{ Auth::guard('pembimbing')->user()->nama_pembimbing }}
            </span>
        @else
            <span class="font-weight-bold text-white mt-5">Pengguna Belum Login</span>
        @endif
    </a>
    </div>


    <hr class="horizontal light mt-2 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link text-white" href="/">
        
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
            </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    {{-- dropdown link halaman kelola data --}}
    @if(Auth::guard('admin')->user())
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Kelola Data</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{Route('datasiswa.index')}}">Kelola Data Siswa</a></li>
            <li><a class="dropdown-item" href="{{Route('datapembimbing.index')}}">Kelola Data Pembimbing</a></li>
            <li><a class="dropdown-item" href="{{Route('datainstansi.index')}}">Kelola Data Instansi</a></li>
            <li><a class="dropdown-item" href="{{Route('dataprakerin.index')}}">Kelola Data Prakerin</a></li>
        </ul>
    </li>
    @endif
    
    @if(Auth::guard('pembimbing')->user())
    <li class="nav-item">
        <a class="nav-link text-white" href="/nilai">
        
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
            </div>
        
        <span class="nav-link-text ms-1">Kelola Penilaian Siswa</span>
        </a>
    </li>
    @endif
    {{-- dropdown link halaman laporan data --}}
    @if(Auth::guard('admin')->user())
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
        </div>
        <span class="nav-link-text ms-1">Laporan Data</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{Route('laporansiswa')}}">Laporan Data Siswa</a></li>
            <li><a class="dropdown-item" href="{{Route('laporanpembimbing')}}">Laporan Data Pembimbing</a></li>
            <li><a class="dropdown-item" href="{{Route('laporanprakerin')}}">Laporan Data Prakerin</a></li>
        </ul>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link text-white" href="/laporan-nilai">
        
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
            </div>
        
        <span class="nav-link-text ms-1">Laporan Penilaian</span>
        </a>
    </li>
    </ul
</div>
</aside>
{{-- end sidebar --}}
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <h6 class="font-weight-bolder mb-0">Informasi Pendataan Prakerin Siswa<br></h6>
            
        </nav>
        
        @if(Auth::guard('pembimbing')->user())
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <li class="nav-item d-flex align-items-center" method="POST">
                    <span class="d-sm-inline d-none"></span>
                    <a href="/logoutP" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Sign out</span>
                    </a>
                </li>
            </div>
        </div>
        @elseif(Auth::guard('admin')->user())
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <li class="nav-item d-flex align-items-center" method="POST">
                    <span class="d-sm-inline d-none"></span>
                    <a href="/logout" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Sign out</span>
                    </a>
                </li>
            </div>
        </div>
        @endif
        </div>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        <li class="nav-item px-3 d-flex align-items-center">
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
    </div>
    <ul class="navbar-nav  justify-content-end">
    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
        </div>
        </a>
    </li>
    <li class="nav-item px-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0">
        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
        </a>
    </li>
    <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell cursor-pointer"></i>
        </a>
    </li>
    </ul>
    </div>
    </div>
    </nav>

    <!-- End Navbar -->

    {{-- konten --}}
    @yield('konten')
    {{-- end konten --}}
<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script>

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
        label: "Sales",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "rgba(255, 255, 255, .8)",
        data: [50, 20, 10, 22, 50, 10, 40],
        maxBarThickness: 6
        }, ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
            suggestedMin: 0,
            suggestedMax: 500,
            beginAtZero: true,
            padding: 10,
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            color: "#fff"
            },
        },
        x: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
        label: "Mobile apps",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
        maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        x: {
            grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
        label: "Mobile apps",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
            display: true,
            padding: 10,
            color: '#f8f9fa',
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        x: {
            grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    
</script>
<!-- Github buttons -->
{{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>