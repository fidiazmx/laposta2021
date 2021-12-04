<?php include 'header.php';?>

<?php include 'sidebar.php';?>

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Trabajos</span></h5>
                            <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="main.html">Home</a>
                            </li>                  
                            <li class="breadcrumb-item active">Trabajos 
                            </li>
                            </ol>
                        </div>
                        <div class="col s2 m6 l6">
                            <!--<a id="add_cliente" href="#modalCliente" class="waves-effect waves-light breadcrumbs-btn right btn modal-trigger" style="display:block;">AGREGAR</a>-->
                            <!--<a id="add_empleado" href="#modalEmpleado" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right modal-trigger" href="#!" data-target="dropdown1">
                                <i class="material-icons hide-on-med-and-up">library_add</i>
                                <span class="hide-on-small-onl">Settings</span>
                                <i class="material-icons right">arrow_drop_down</i></a>-->
                            <ul class="dropdown-content" id="dropdown1" tabindex="0">
                            <!--<li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Profile<span class="new badge red">2</span></a></li>
                            <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">Contacts</a></li>
                            <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">FAQ</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">Logout</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <!-- datatable start -->
                                <div class="responsive-table">
                                    <table id="data-table-simple" class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Id</th>
                                            <th>Cliente</th>
                                            <th>Desc.</th>
                                            <th>Fab.</th>
                                            <th>Inst.</th>
                                            <th>Ter.</th>
                                            <th>($)Pagado</th>
                                            <th>($)Adeuda</th>
                                            <th>($)Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <!--
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>Fidel D Mendez</td>
                                                <td></td>
                                                <td>
                                                    <div class="invoice-action">
                                                        <a href="#" style="color: green;" data-estado="Fabricado" class="invoice-action-edit cambiaestado">
                                                            <i class="material-icons">check_circle</i>
                                                        </a>                                                                                             
                                                    </div>
                                                </td>   
                                                <td>
                                                    <div class="invoice-action">
                                                        <a href="#" style="color: green;" data-estado="Instalado" class="invoice-action-edit cambiaestado">
                                                            <i class="material-icons">check_circle</i>
                                                        </a>                                                                                             
                                                    </div>
                                                </td>   
                                                <td>
                                                    <div class="invoice-action">
                                                        <a href="#" style="color: gray;" data-estado="Terminado" class="invoice-action-edit cambiaestado">
                                                            <i class="material-icons">check_circle</i>
                                                        </a>                                                                                             
                                                    </div>
                                                </td>     
                                                <td>1200.00</td>
                                                <td>25000.00</td>
                                                <td>3500.00</td>                                                  
                                                <td>
                                                    <div class="invoice-action">
                                                        <a href="#" class="function_trabajos">Historial</a>
                                                        <a href="#" class="function_anticipo">Anticipo</a>                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            -->
                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                    </section>
                    <!-- users list ends --><!-- START RIGHT SIDEBAR NAV -->
                    <aside id="right-sidebar-nav">
                    <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
                        <div class="row">
                        <div class="slide-out-right-title">
                            <div class="col s12 border-bottom-1 pb-0 pt-1">
                            <div class="row">
                                <div class="col s2 pr-0 center">
                                <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
                                </div>
                                <div class="col s10 pl-0">
                                <ul class="tabs">
                                    <li class="tab col s4 p-0">
                                    <a href="#messages" class="active">
                                        <span>Messages</span>
                                    </a>
                                    </li>
                                    <li class="tab col s4 p-0">
                                    <a href="#settings">
                                        <span>Settings</span>
                                    </a>
                                    </li>
                                    <li class="tab col s4 p-0">
                                    <a href="#activity">
                                        <span>Activity</span>
                                    </a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="slide-out-right-body row pl-3">
                            <div id="messages" class="col s12 pb-0">
                            <div class="collection border-none mb-0">
                                <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
                                <ul class="collection right-sidebar-chat p-0 mb-0">
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-7.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Elizabeth Elliott</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.00 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-1.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Mary Adams</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-2.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Caleb Richards</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-3.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Caleb Richards</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
                                    </div>
                                    <span class="secondary-content medium-small">9.00 PM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-4.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">June Lane</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-5.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Edward Fletcher</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.15 PM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-6.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Crystal Bates</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
                                    </div>
                                    <span class="secondary-content medium-small">8.00 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-7.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Nathan Watts</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
                                    </div>
                                    <span class="secondary-content medium-small">9.53 PM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-8.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Willard Wood</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.20 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-1.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Ronnie Ellis</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.20 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-9.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Daniel Russell</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                                    </div>
                                    <span class="secondary-content medium-small">12.00 AM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-10.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Sarah Graves</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
                                    </div>
                                    <span class="secondary-content medium-small">11.14 PM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"><img
                                        src="app-assets/images/avatar/avatar-11.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Andrew Hoffman</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
                                    </div>
                                    <span class="secondary-content medium-small">7.30 PM</span>
                                </li>
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                                    data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"><img
                                        src="app-assets/images/avatar/avatar-12.png" alt="avatar" />
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Camila Lynch</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
                                    </div>
                                    <span class="secondary-content medium-small">2.00 PM</span>
                                </li>
                                </ul>
                            </div>
                            </div>
                            <div id="settings" class="col s12">
                            <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>
                            <ul class="collection border-none">
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Notifications</span>
                                    <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Show recent activity</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Show recent activity</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Show Task statistics</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Show your emails</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Email Notifications</span>
                                    <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                            </ul>
                            <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>
                            <ul class="collection border-none">
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>System Logs</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Error Reporting</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Applications Logs</span>
                                    <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Backup Servers</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                                <li class="collection-item border-none">
                                <div class="m-0">
                                    <span>Audit Logs</span>
                                    <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                    </div>
                                </div>
                                </li>
                            </ul>
                            </div>
                            <div id="activity" class="col s12">
                            <div class="activity">
                                <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
                                <ul class="widget-timeline mb-0">
                                <li class="timeline-items timeline-icon-green active">
                                    <div class="timeline-time">Today</div>
                                    <h6 class="timeline-title">Homepage mockup design</h6>
                                    <p class="timeline-text">Melissa liked your activity.</p>
                                    <div class="timeline-content orange-text">Important</div>
                                </li>
                                <li class="timeline-items timeline-icon-cyan active">
                                    <div class="timeline-time">10 min</div>
                                    <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content green-text">Resolved</div>
                                </li>
                                <li class="timeline-items timeline-icon-red active">
                                    <div class="timeline-time">30 mins</div>
                                    <h6 class="timeline-title">12 new users registered</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content">
                                    <img src="app-assets/images/icon/pdf.png" alt="document" height="30" width="25"
                                        class="mr-1">Registration.doc
                                    </div>
                                </li>
                                <li class="timeline-items timeline-icon-indigo active">
                                    <div class="timeline-time">2 Hrs</div>
                                    <h6 class="timeline-title">Tina is attending your activity</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content">
                                    <img src="app-assets/images/icon/pdf.png" alt="document" height="30" width="25"
                                        class="mr-1">Activity.doc
                                    </div>
                                </li>
                                <li class="timeline-items timeline-icon-orange">
                                    <div class="timeline-time">5 hrs</div>
                                    <h6 class="timeline-title">Josh is now following you</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content red-text">Pending</div>
                                </li>
                                </ul>
                                <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
                                <ul class="widget-timeline mb-0">
                                <li class="timeline-items timeline-icon-green active">
                                    <div class="timeline-time">Just now</div>
                                    <h6 class="timeline-title">New order received urgent</h6>
                                    <p class="timeline-text">Melissa liked your activity.</p>
                                    <div class="timeline-content orange-text">Important</div>
                                </li>
                                <li class="timeline-items timeline-icon-cyan active">
                                    <div class="timeline-time">05 min</div>
                                    <h6 class="timeline-title">System shutdown.</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content blue-text">Urgent</div>
                                </li>
                                <li class="timeline-items timeline-icon-red">
                                    <div class="timeline-time">20 mins</div>
                                    <h6 class="timeline-title">Database overloaded 89%</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content">
                                    <img src="app-assets/images/icon/pdf.png" alt="document" height="30" width="25"
                                        class="mr-1">Database-log.doc
                                    </div>
                                </li>
                                </ul>
                                <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
                                <ul class="widget-timeline mb-0">
                                <li class="timeline-items timeline-icon-green active">
                                    <div class="timeline-time">10 min</div>
                                    <h6 class="timeline-title">System error</h6>
                                    <p class="timeline-text">Melissa liked your activity.</p>
                                    <div class="timeline-content red-text">Error</div>
                                </li>
                                <li class="timeline-items timeline-icon-cyan">
                                    <div class="timeline-time">1 min</div>
                                    <h6 class="timeline-title">Production server down.</h6>
                                    <p class="timeline-text">Here are some news feed interactions concepts.</p>
                                    <div class="timeline-content blue-text">Urgent</div>
                                </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Slide Out Chat -->
                    <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
                        <li class="center-align pt-2 pb-2 sidenav-close chat-head">
                        <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
                        </li>
                        <li class="chat-body">
                        <ul class="collection">
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">hello!</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">How can we help? We're here for you!</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">I am looking for the best admin template.?</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
                            </div>
                            </li>

                            <li class="collection-item display-grid width-100 center-align">
                            <p>8:20 a.m.</p>
                            </li>

                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">Ohh! very nice</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">Thank you.</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">How can I purchase it?</p>
                            </div>
                            </li>

                            <li class="collection-item display-grid width-100 center-align">
                            <p>9:00 a.m.</p>
                            </li>

                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">From ThemeForest.</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">Only $24</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">Ohh! Thank you.</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                            <span class="avatar-status avatar-online avatar-50"><img src="app-assets/images/avatar/avatar-7.png"
                                alt="avatar" />
                            </span>
                            <div class="user-content speech-bubble">
                                <p class="medium-small">I will purchase it for sure.</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">Great, Feel free to get in touch on</p>
                            </div>
                            </li>
                            <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                            <div class="user-content speech-bubble-right">
                                <p class="medium-small">https://pixinvent.ticksy.com/</p>
                            </div>
                            </li>
                        </ul>
                        </li>
                        <li class="center-align chat-footer">
                        <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">
                            <div class="input-field">
                            <input id="icon_prefix" type="text" class="search" />
                            <label for="icon_prefix">Type here..</label>
                            <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>
                            </div>
                        </form>
                        </li>
                    </ul>
                    </aside>
                    <!-- END RIGHT SIDEBAR NAV -->
                    <div style="bottom: 50px; right: 19px; display: none;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
                        <ul>
                            <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
                            <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
                            <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
                            <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- Theme Customizer -->

<a
   href="#" style="display:none;"
   data-target="theme-cutomizer-out"
   class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger"
   ><i class="material-icons">settings</i></a
>

<div id="theme-cutomizer-out" style="display: none;" class="theme-cutomizer sidenav row">
   <div class="col s12">
      <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
      <h5 class="theme-cutomizer-title">Theme Customizer</h5>
      <p class="medium-small">Customize & Preview in Real Time</p>
      <div class="menu-options">
         <h6 class="mt-6">Menu Options</h6>
         <hr class="customize-devider" />
         <div class="menu-options-form row">
            <div class="input-field col s12 menu-color mb-0">
               <p class="mt-0">Menu Color</p>
               <div class="gradient-color center-align">
                  <span class="menu-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                  <span
                     class="menu-color-option gradient-45deg-purple-deep-orange"
                     data-color="gradient-45deg-purple-deep-orange"
                  ></span>
                  <span
                     class="menu-color-option gradient-45deg-light-blue-cyan"
                     data-color="gradient-45deg-light-blue-cyan"
                  ></span>
                  <span
                     class="menu-color-option gradient-45deg-purple-amber"
                     data-color="gradient-45deg-purple-amber"
                  ></span>
                  <span
                     class="menu-color-option gradient-45deg-purple-deep-purple"
                     data-color="gradient-45deg-purple-deep-purple"
                  ></span>
                  <span
                     class="menu-color-option gradient-45deg-deep-orange-orange"
                     data-color="gradient-45deg-deep-orange-orange"
                  ></span>
                  <span class="menu-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                  <span
                     class="menu-color-option gradient-45deg-indigo-light-blue"
                     data-color="gradient-45deg-indigo-light-blue"
                  ></span>
                  <span class="menu-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
               </div>
               <div class="solid-color center-align">
                  <span class="menu-color-option red" data-color="red"></span>
                  <span class="menu-color-option purple" data-color="purple"></span>
                  <span class="menu-color-option pink" data-color="pink"></span>
                  <span class="menu-color-option deep-purple" data-color="deep-purple"></span>
                  <span class="menu-color-option cyan" data-color="cyan"></span>
                  <span class="menu-color-option teal" data-color="teal"></span>
                  <span class="menu-color-option light-blue" data-color="light-blue"></span>
                  <span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
                  <span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
               </div>
            </div>
            <div class="input-field col s12 menu-bg-color mb-0">
               <p class="mt-0">Menu Background Color</p>
               <div class="gradient-color center-align">
                  <span
                     class="menu-bg-color-option gradient-45deg-indigo-blue"
                     data-color="gradient-45deg-indigo-blue"
                  ></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-purple-deep-orange"
                     data-color="gradient-45deg-purple-deep-orange"
                  ></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-light-blue-cyan"
                     data-color="gradient-45deg-light-blue-cyan"
                  ></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-purple-amber"
                     data-color="gradient-45deg-purple-amber"
                  ></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-purple-deep-purple"
                     data-color="gradient-45deg-purple-deep-purple"
                  ></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-deep-orange-orange"
                     data-color="gradient-45deg-deep-orange-orange"
                  ></span>
                  <span class="menu-bg-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                  <span
                     class="menu-bg-color-option gradient-45deg-indigo-light-blue"
                     data-color="gradient-45deg-indigo-light-blue"
                  ></span>
                  <span class="menu-bg-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
               </div>
               <div class="solid-color center-align">
                  <span class="menu-bg-color-option red" data-color="red"></span>
                  <span class="menu-bg-color-option purple" data-color="purple"></span>
                  <span class="menu-bg-color-option pink" data-color="pink"></span>
                  <span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
                  <span class="menu-bg-color-option cyan" data-color="cyan"></span>
                  <span class="menu-bg-color-option teal" data-color="teal"></span>
                  <span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
                  <span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
                  <span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  Menu Dark
                  <label class="float-right"
                     ><input class="menu-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                  ></label>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  Menu Collapsed
                  <label class="float-right"
                     ><input class="menu-collapsed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                  ></label>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  <p class="mt-0">Menu Selection</p>
                  <label>
                     <input
                        class="menu-selection-radio with-gap"
                        value="sidenav-active-square"
                        name="menu-selection"
                        type="radio"
                     />
                     <span>Square</span>
                  </label>
                  <label>
                     <input
                        class="menu-selection-radio with-gap"
                        value="sidenav-active-rounded"
                        name="menu-selection"
                        type="radio"
                     />
                     <span>Rounded</span>
                  </label>
                  <label>
                     <input class="menu-selection-radio with-gap" value="" name="menu-selection" type="radio" />
                     <span>Normal</span>
                  </label>
               </div>
            </div>
         </div>
      </div>
      <h6 class="mt-6">Navbar Options</h6>
      <hr class="customize-devider" />
      <div class="navbar-options row">
         <div class="input-field col s12 navbar-color mb-0">
            <p class="mt-0">Navbar Color</p>
            <div class="gradient-color center-align">
               <span class="navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
               <span
                  class="navbar-color-option gradient-45deg-purple-deep-orange"
                  data-color="gradient-45deg-purple-deep-orange"
               ></span>
               <span
                  class="navbar-color-option gradient-45deg-light-blue-cyan"
                  data-color="gradient-45deg-light-blue-cyan"
               ></span>
               <span class="navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
               <span
                  class="navbar-color-option gradient-45deg-purple-deep-purple"
                  data-color="gradient-45deg-purple-deep-purple"
               ></span>
               <span
                  class="navbar-color-option gradient-45deg-deep-orange-orange"
                  data-color="gradient-45deg-deep-orange-orange"
               ></span>
               <span class="navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
               <span
                  class="navbar-color-option gradient-45deg-indigo-light-blue"
                  data-color="gradient-45deg-indigo-light-blue"
               ></span>
               <span class="navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
            </div>
            <div class="solid-color center-align">
               <span class="navbar-color-option red" data-color="red"></span>
               <span class="navbar-color-option purple" data-color="purple"></span>
               <span class="navbar-color-option pink" data-color="pink"></span>
               <span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
               <span class="navbar-color-option cyan" data-color="cyan"></span>
               <span class="navbar-color-option teal" data-color="teal"></span>
               <span class="navbar-color-option light-blue" data-color="light-blue"></span>
               <span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
               <span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Navbar Dark
               <label class="float-right"
                  ><input class="navbar-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
               ></label>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Navbar Fixed
               <label class="float-right"
                  ><input class="navbar-fixed-checkbox" type="checkbox" checked/> <span class="lever ml-0"></span
               ></label>
            </div>
         </div>
      </div>
      <h6 class="mt-6">Footer Options</h6>
      <hr class="customize-devider" />
      <div class="navbar-options row">
         <div class="input-field col s12">
            <div class="switch">
               Footer Dark
               <label class="float-right"
                  ><input class="footer-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
               ></label>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Footer Fixed
               <label class="float-right"
                  ><input class="footer-fixed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
               ></label>
            </div>
         </div>
      </div>
   </div>
</div>
<!--/ Theme Customizer -->

<a
   href="https://1.envato.market/materialize_admin"
   target="_blank" style="display: none;"
   class="btn btn-buy-now gradient-45deg-indigo-purple gradient-shadow white-text tooltipped buy-now-animated tada"
   data-position="left"
   data-tooltip="Buy Now!"
   ><i class="material-icons">add_shopping_cart</i></a
>
    
    <div id="modalAnticipos" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h6 class="card-title"></h4>
            <form>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="" id="txtDescripcion" name="txtDescripcion" type="text">
                        <label for="txtDescripcion" class="active">Descripción anticipo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="" id="txtAnticipo" name="txtAnticipo" type="text">
                        <label for="txtAnticipo" class="active">Anticipo</label>
                    </div>
                </div>                  
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action waves-effect waves-red btn-flat ">Guardar</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
        </div>
    </div>

    <?php include 'footer.php';?>
<script src="app-assets/js/app/trabajos.js"></script>