<!-- Author : BELGHARBI Meryem / Reflexion et débogage en binôme-->
<!-- Start notification widget -->

<?php
if ($context->notification!="") {
	?>
    <div class="alert alert-<?=$context->notificationType?>">
        <strong><?=$context->notification?>.</strong>
    </div>

    <?php
}

?>
<!-- End notification widget -->
