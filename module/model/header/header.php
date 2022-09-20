<?php
    $COL = '#DBA530';
    // $COL = "red";
?>
<div class="navbar-toolbar clearfix" style="background-color: <?php echo $COL; ?> ;">
    <ul class="nav navbar-nav navbar-left">
        <li class="hidden-xs hidden-sm">
            <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar" style="background-color: <?= $COL; ?> ;">
                <span class="meta">
                    <span class="icon"></span>
                </span>
            </a>
        </li>
        <li class="navbar-main hidden-lg hidden-md hidden-sm">
            <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
                <span class="meta">
                    <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                </span>
            </a>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown profile">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="background-color: <?= $COL; ?> ;">
                <span class="meta">
                    <span class="text hidden-xs hidden-sm pl5"><?php echo $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];?>
                    </span>
                </span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <!-- <li><a href="edit_profile.php"><span class="icon"><i class="ico-cog4"></i></span> Edit Profile</a></li> -->
                <li><a href="manual book/PANDUAN PTK ONLINE.pdf" target="_blank"><span class="icon"><i class="ico-book2"></i></span> Manual Book</a></li>
                <li><a href="user_log"><span class="icon"><i class="fas fa-user-cog"></i></span> Log Aktivitas</a></li>
                <?php if($_SESSION['LOGINAKS_PERSONALIA_BB'] == "Administrator" or $_SESSION['LOGINAKS_PERSONALIA_BB'] == "Recruitment"){ ?>
                    <li><a href="email" target="_blank"><span class="icon"><i class="fas fa-envelope"></i></span> Tes Email</a></li>
                    <li><a href="config"><span class="icon"><i class="fas fa-cog"></i></span> Config</a></li>
                <?php } ?>
                <li class="divider"></li>
                <li><a href="logout"><span class="icon"><i class="ico-exit"></i></span> Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>
