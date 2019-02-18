<!-- Author : AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start Main Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center" >
        <div class="avatar"><img src="<?=$context->user->getAvatar()?>" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4"><?php echo  $context->user->getPrenom()." ".$context->user->getNom(); ?></h1>
            <p><?=$context->user->getStatut()?></p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main Menu</span>
    <ul class="list-unstyled">
        <li <?php if($action=="index")echo 'class="active"';?> > <a href="?action=index"><i class="fa fa-home"></i>Home</a></li>
        <li <?php if($action=="profile")echo 'class="active"';?> > <a href="?action=profile"> <i class="fa fa-user"></i>Profile</a></li>
        <li <?php if($action=="friends")echo 'class="active"';?> > <a href="?action=friends"> <i class="fa fa-users"></i>Friends</a></li>
        <li <?php if($action=="disclaimer")echo 'class="active"';?> > <a href="?action=disclaimer"> <i class="fa fa-exclamation-triangle"></i>Disclaimer</a></li>
    </ul>
</nav>
<!-- End Main Navbar -->
