<!-- Author : BELGHARBI Meryem / Reflexion et débogage en binôme-->
<!-- Start of layout -->

<?php include($header_view); ?>
<div class="page home-page">
    <?php include($navbar_view); ?>

    <div class="page-content d-flex align-items-stretch" id="moveInHere">
        <?php include($sidebar_view); ?>
        <div class="content-inner">
            <?php include($template_view); ?>

        </div>
    </div>
</div>
<?php include($chat_view); ?>
<?php include($footer_view); ?>
<!-- End of layout -->
