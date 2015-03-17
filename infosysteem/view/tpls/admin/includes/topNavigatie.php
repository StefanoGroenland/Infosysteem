<header>
    <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">

            <div class="pull-right">

                <ul class="nav navbar-nav pull-right">

                    <li class="dropdown notifications hidden-xs">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true"
                                                                                         class="se7en-flag"></span>

                            <div class="sr-only">
                                Notificaties
                            </div>
                            <p class="counter">
                                <?php foreach ($notificaties as $notificatie) : ?>
                                <?php

                                    if ($notificatie->geefActive() === 'active') {
                                        echo count($notificatie);
                                    } else {
                                        echo '0';
                                    }

                                ?>
                            </p>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a id="notificatie"
                                   href=".?control=admin&amp;action=storingenBeheer&status=non-active&id=<?php echo $notificatie->geefId(); ?>">
                                    <?php
                                        if ($notificatie->geefActive() === "active") {
                                            echo '<div class="notifications label label-info">
                                                New
                                                </div>';
                                        }
                                    ?>

                                    <p>
                                        <?php echo $notificatie->geefBeschrijving(); ?>
                                    </p>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown messages hidden-xs">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true"
                                                                                         class="se7en-envelope"></span>

                            <div class="sr-only">
                                Messages
                            </div>
                            <p class="counter">
                                3
                            </p>
                        </a>
                        <ul class="dropdown-menu messages">
                            <li><a href="#">
                                    <img width="34" height="34" src="images/avatar-male2.png"/>Could we meet today? I
                                    wanted...</a>
                            </li>
                            <li><a href="#">
                                    <img width="34" height="34" src="images/avatar-female.png"/>Important data needs
                                    your analysis...</a>
                            </li>
                            <li><a href="#">
                                    <img width="34" height="34" src="images/avatar-male2.png"/>Buy Se7en today, it's a
                                    great theme...</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <img width="34" height="34"
                                 src="images/<?php echo $_SESSION['gebruiker']->geefFoto(); ?>"/> <?php echo $_SESSION['gebruiker']->geefNaam(); ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./?control=admin&action=wijzigMijnGegevens&gebruiker_id=<?php echo $_SESSION['gebruiker']->geefId(); ?> ">
                                    <i class="fa fa-user"></i>My Account</a>
                            </li>
                            <li><a href="./?control=admin&action=GlobalSettings">
                                    <i class="fa fa-gear"></i>Global Settings</a>
                            </li>
                            <li><a href="./?control=admin&action=storingenBeheer">
                                    <i class="fa fa-gear"></i>Storingen</a>
                            </li>
                            <li><a href="./?control=admin&action=logsBeheer">
                                    <i class="fa fa-archive"></i>Logs</a>
                            </li>
                            <li><a href="./?control=admin&action=beschikbaarheid">
                                    <i class="fa fa-archive"></i>Beschikbaarheid</a>
                            </li>
                            <li><a href="./?control=admin&action=uitloggen">
                                    <i class="fa fa-sign-out"></i>Logout</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span
                    class="icon-bar"></span></button>
            <a class="logo" href=".?control=<?php echo $_SESSION['gebruiker']->geefRecht(); ?>&action=default">AIS</a>

            <form class="navbar-form form-inline col-lg-2 hidden-xs">
                <input class="form-control" placeholder="Search" type="text">
            </form>
            <li style="text-align:center; font-size:12px;margin-top:7px; list-style: none;">
                Week : <?php echo date("W"); ?>
                </br>
                Datum : <?php echo date("d-m-Y"); ?>

            </li>
        </div>
        <div class="container-fluid main-nav clearfix">
            <div class="nav-collapse">
                <ul class="nav">


                    <li>
                        <a href="./?control=admin&action=default">
                            <span aria-hidden="true" class="se7en-home"></span>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="./?control=admin&action=tickets">
                            <span aria-hidden="true" class="se7en-feed"></span>Tickets
                        </a>
                    </li>

                    <!-- <li>
                         <a href="./?control=admin&action=rapporten">
                             <span aria-hidden="true" class="se7en-forms"></span>Rapporten
                         </a>
                     </li>
                    -->
                    <li>
                        <a href="./?control=admin&action=klanten">
                            <span aria-hidden="true" class="se7en-pages"></span>Klanten
                        </a>
                    </li>

                    <li>
                        <a href="./?control=admin&action=escalaties">
                            <span aria-hidden="true" class="se7en-tables"></span>Escalaties
                        </a>
                    </li>


                    <li>
                        <a href="./?control=admin&action=gebruikersBeheer">
                            <span aria-hidden="true" class="se7en-gear"></span>Gebruikers
                        </a>
                    </li>
                    <li><a href="./?control=admin&action=factuur">
                            <span aria-hidden="true" class="se7en-pages"></span>Factuur</a>
                    </li>
                    <li>
                        <a href="./?control=admin&action=magazijn">
                            <span aria-hidden="true" class="se7en-feed"></span>Magazijn
                        </a>
                    </li>
                    <li>
                        <a href="./?control=admin&action=calendar">
                            <span aria-hidden="true" class="se7en-feed"></span>Kalender
                        </a>
                    </li>
                    <li>
                        <a href="./?control=admin&action=beschikbareExperts">
                            <span aria-hidden="true" class="se7en-tables"></span>Beschikbare Experts
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</header>