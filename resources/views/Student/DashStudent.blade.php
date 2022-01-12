<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    {{-- <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet"> --}}
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/select2/css/select2.min.css">
        <link rel="stylesheet" href="./vendor/toastr/css/toastr.min.css">
         <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
             <link rel="stylesheet" href="./vendor/chartist/css/chartist.min.css">
             
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="./images/logo.png" alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
                &ensp;GesEcole
                {{-- <img class="brand-title" src="./images/logo-text.png" alt=""> --}}
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    {{-- <h1>{{ Auth::guard("admin")->user()->email }}</h1> --}}
                    <div class="collapse navbar-collapse justify-content-between">
                       

                        <ul class="navbar-nav header-right">
                           
                            
                        </ul>
                        <form method="POST" action="{{ url('/logoutstudent') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Déconnexion</span>
                                    </button>
                                </form>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
         <div id="app">
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li>
                        <router-link tag="a" to="/accueil/eleve"  class="nav-link">
                            <i class="fas fa-bars"></i>
                             <span class="nav-text">accueil</span>
                        </router-link>
                    </li>
                    <li class="nav-label">Apps</li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                          <i class="fas fa-folder"></i><span class="nav-text">Les cours</span></a>
                        <ul aria-expanded="false">
                            <li>
                                <router-link tag="a" to="/cours/exercices"  class="nav-link">
                                    Les cours et les exercices
                                </router-link>
                            </li>
                        </ul>
                    </li>
                   
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                         <i class="fab fa-acquisitions-incorporated"></i>
                                <span class="nav-text">Les examens</span></a>
                        <ul aria-expanded="false">
                            <li><router-link to="/examen">Les examens</router-link></li>

                            
                        </ul>
                    </li>
                   
                   


                   
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
               
                    
                    <router-view></router-view>
                  
               
            </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by </p>
                <p>Youssef Akchar,Younes Hemmi,Mohamed </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        </div>
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="./vendor/global/global.min.js"></script>
{{-- //scrool --}}
    <script src="./js/quixnav-init.js"></script>

    <script src="./js/custom.min.js"></script>
    <script src="./vendor/select2/js/select2.full.min.js"></script>
    <script src="./js/plugins-init/select2-init.js"></script>

      <!-- Toastr -->
    <script src="./vendor/toastr/js/toastr.min.js"></script>

    <script src="https://kit.fontawesome.com/47e2cff383.js" crossorigin="anonymous"></script>
    <!-- All init script -->
    <script src="./js/plugins-init/toastr-init.js"></script>
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

     <!-- Chart ChartJS plugin files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
   
    {{-- <script src="./vendor/chartist/js/chartist.min.js"></script>
    

    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>

 
    <script src="./js/dashboard/dashboard-2.js"></script> --}}
    <!-- Circle progress -->

</body>

</html>