<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Panel de Control | La Posta</title>
    <link rel="apple-touch-icon" href="app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/flag-icon/css/flag-icon.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <!--<div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">
                        <ul class="search-list collection display-none"></ul>
                    </div>-->
                    <ul class="navbar-list right">
                        <li><span id="spanUsuario" style="color:black;">...</span></li>
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="app-assets/images/avatar/avatar-7.png" alt="avatar"><i></i></span></a></li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <!--<li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
                        <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
                        <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
                        <li class="divider"></li>
                        <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>-->
                        <li><a id="#btnCerrarSesion" class="grey-text text-darken-1" href="index.php"><i class="material-icons">keyboard_tab</i> Cerrar sesión</a></li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <!-- END: Header-->
    <ul class="display-none" id="default-search-main">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">FILES</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="app-assets/images/icon/pdf-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Two new item submitted</span><small class="grey-text">Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">17kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="app-assets/images/icon/doc-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file Generator</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">550kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="app-assets/images/icon/xls-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">20kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="app-assets/images/icon/jpg-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">37kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">MEMBERS</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="app-assets/images/avatar/avatar-7.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">John Doe</span><small class="grey-text">UI designer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="app-assets/images/avatar/avatar-8.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Michal Clark</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="app-assets/images/avatar/avatar-10.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Milena Gibson</span><small class="grey-text">Digital Marketing</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="app-assets/images/avatar/avatar-12.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="display-none" id="page-search-title">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">PAGES</h6>
            </a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
        <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
    </ul>



    <!-- BEGIN: SideNav-->
    <?php include 'sidebar.php';?>

    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Editar Contacto</span></h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="main.php">Home</a>
                                </li>                               
                                <li class="breadcrumb-item active">Editar Contacto
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section">     
                        <form id="form-contacto">                
                            <!-- BAND -->
                            <div class="row">
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Contacto Banderilla</h4>                                                                        
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <label for="txtTelBand">Tel. Banderilla</label>
                                                            <input class="validate" required id="txtTelBand" name="txtTelBand" type="text" placeholder="">
                                                        </div> 
                                                        <div class="input-field col s6">
                                                            <label for="txtCorreoBand">Correo Banderilla</label>
                                                            <input class="validate" required id="txtCorreoBand" name="txtCorreoBand" type="text" placeholder="">
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s4">
                                                            <label for="txtHor1Band">Horario Lun-Vie</label>
                                                            <input class="validate" required id="txtHor1Band" name="txtHor1Band" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor2Band">Horario Sab.</label>
                                                            <input class="validate" required id="txtHor2Band" name="txtHor2Band" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor3Band">Horario Dom.</label>
                                                            <input class="validate" required id="txtHor3Band" name="txtHor3Band" type="text" placeholder="">
                                                        </div>      
                                                    </div>
                                                    <div class="row">   
                                                        <div class="input-field col s12">
                                                            <label for="txtDirBand">Dirección Banderilla</label>
                                                            <input class="validate" required id="txtDirBand" name="txtDirBand" type="text" placeholder="">
                                                        </div>  
                                                    </div>                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BAND -->  
                            <!-- BAND -->
                            <div class="row">
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Contacto Acajete</h4>                                                                        
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <label for="txtTelAcaj">Tel. Acajete</label>
                                                            <input class="validate" required id="txtTelAcaj" name="txtTelAcaj" type="text" placeholder="">
                                                        </div> 
                                                        <div class="input-field col s6">
                                                            <label for="txtCorreoAcaj">Correo Acajete</label>
                                                            <input class="validate" required id="txtCorreoAcaj" name="txtCorreoAcaj" type="text" placeholder="">
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s4">
                                                            <label for="txtHor1Acaj">Horario Lun-Vie</label>
                                                            <input class="validate" required id="txtHor1Acaj" name="txtHor1Acaj" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor2Acaj">Horario Sab.</label>
                                                            <input class="validate" required id="txtHor2Acaj" name="txtHor2Acaj" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor3Acaj">Horario Dom.</label>
                                                            <input class="validate" required id="txtHor3Acaj" name="txtHor3Acaj" type="text" placeholder="">
                                                        </div>      
                                                    </div>
                                                    <div class="row">   
                                                        <div class="input-field col s12">
                                                            <label for="txtDirAcaj">Dirección Acajete</label>
                                                            <input class="validate" required id="txtDirAcaj" name="txtDirAcaj" type="text" placeholder="">
                                                        </div>  
                                                    </div>                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BAND -->  
                            <!-- BAND -->
                            <div class="row">
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Contacto Mataoscura</h4>                                                                        
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <label for="txtTelMata">Tel. Mataoscura</label>
                                                            <input class="validate" required id="txtTelMata" name="txtTelMata" type="text" placeholder="">
                                                        </div> 
                                                        <div class="input-field col s6">
                                                            <label for="txtCorreoMata">Correo Mataoscura</label>
                                                            <input class="validate" required id="txtCorreoMata" name="txtCorreoMata" type="text" placeholder="">
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s4">
                                                            <label for="txtHor1Mata">Horario Lun-Vie</label>
                                                            <input class="validate" required id="txtHor1Mata" name="txtHor1Mata" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor2Mata">Horario Sab.</label>
                                                            <input class="validate" required id="txtHor2Mata" name="txtHor2Mata" type="text" placeholder="">
                                                        </div>  
                                                        <div class="input-field col s4">
                                                            <label for="txtHor3Mata">Horario Dom.</label>
                                                            <input class="validate" required id="txtHor3Mata" name="txtHor3Mata" type="text" placeholder="">
                                                        </div>      
                                                    </div>
                                                    <div class="row">   
                                                        <div class="input-field col s12">
                                                            <label for="txtDirMata">Dirección Mataoscura</label>
                                                            <input class="validate" required id="txtDirMata" name="txtDirMata" type="text" placeholder="">
                                                        </div>  
                                                    </div>                                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BAND -->                                                                              
                            <div class="input-field col s12">
                                <button id="btnGuarda" name="btnGuarda" type="button" class="btn waves-effect waves-light right">Actualizar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>                    
                </div>
                <div class="content-overlay"></div>
            </div>             
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2021 <a href="#" target="_blank">La Posta</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="#">Iwebyou</a></span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="app-assets/js/plugins.js"></script>
    <script src="app-assets/js/search.js"></script>
    <script src="app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/vendors/sweetalert/sweetalert.min.js"></script>
    <script src="app-assets/js/urlbase.js"></script>
    <script src="app-assets/js/app/editar-contacto.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>