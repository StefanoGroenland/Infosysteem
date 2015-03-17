<header>
    <div class="navbar navbar-fixed-top scroll-hide">
                <div class="container-fluid top-bar">
                    <div class="pull-right">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown notifications hidden-xs">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-flag"></span>
                                    <div class="sr-only">
                                        Notifications
                                    </div>
                                    <p class="counter">
                                        4
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New user added: Jane Smith
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                Sales targets available
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New performance metric added
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New growth data available
                                            </p></a>

                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown messages hidden-xs">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-envelope"></span>
                                    <div class="sr-only">
                                        Messages
                                    </div>
                                    <p class="counter">
                                        3
                                    </p>
                                </a>
                                <ul class="dropdown-menu messages">
                                    <li><a href="#">
                                            <img width="34" height="34" src="images/avatar-male2.png" />Could we meet today? I wanted...</a>
                                    </li>
                                    <li><a href="#">
                                            <img width="34" height="34" src="images/avatar-female.png" />Important data needs your analysis...</a>
                                    </li>
                                    <li><a href="#">
                                            <img width="34" height="34" src="images/avatar-male2.png" />Buy Se7en today, it's a great theme...</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="">
                                    <img width="34" height="34" src="images/avatar-male.jpg" /> <?php echo $_SESSION['gebruiker']->geefNaam(); ?>  <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./?control=stage&action=wijzigMijnGegevens&gebruiker_id=<?php echo $_SESSION['gebruiker']->geefId(); ?> ">
                                            <i class="fa fa-user"></i>My Account</a>
                                    </li>
                                    <li><a href="./?control=stage&action=wijzigMijnGegevens&gebruiker_id=<?php echo $_SESSION['gebruiker']->geefId(); ?>">
                                            <i class="fa fa-gear"></i>Account Settings</a>
                                    </li>
                                    <li><a href="./?control=stage&action=uitloggen">
                                            <i class="fa fa-sign-out"></i>Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="default.php">AIS</a>
                    <form class="navbar-form form-inline col-lg-2 hidden-xs">
                        <input class="form-control" placeholder="Search" type="text">
                    </form>
                </div>
    <div class="container-fluid main-nav clearfix">
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li>
                                <a href="./?control=stage&action=default"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                            </li>
                            <li>
                                <a href="./?control=stage&action=tickets">
                                    <span aria-hidden="true" class="se7en-feed"></span>Tickets
                                </a>
                            </li>
                            
                            <li>
                                <a href="./?control=stage&action=rapporten">
                                    <span aria-hidden="true" class="se7en-forms"></span>Rapporten
                                </a>
                            </li>
                            
                            <li>
                                <a href="./?control=stage&action=klanten">
                                    <span aria-hidden="true" class="se7en-pages"></span>Klanten
                                </a>
                            </li>
                            
                            <li>
                                <a href="./?control=stage&action=escalaties">
                                    <span aria-hidden="true" class="se7en-tables"></span>Escalaties
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
</header>