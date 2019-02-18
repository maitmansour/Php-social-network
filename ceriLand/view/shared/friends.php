<!-- Author : AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start friend widget -->

<?php  foreach ($context->users as $key => $value) {
    if (!filter_var($value->getAvatar(), FILTER_VALIDATE_URL)) {
      $value->setAvatar($context->unavailable_picture_path);
    }
    ?>
<div class="col-lg-3">
    <div class="client card">
        <div class="card-body text-center">
            <div class="client-avatar">
                <a href="ceriLand.php?action=profile&id=<?=$value->getId()?>">
              <img src="<?=$value->getAvatar()?>" class="img-fluid rounded-circle" style="height: 100px;" >
            </a>
            </div>
            <div class="client-title">
                <h3>
                    <?=$value->getPrenom()?>
                        <?=$value->getNom()?>
                </h3><span><?=substr($value->getStatut(), 0,12)?>...</span>
            </div>
        </div>
    </div>
</div>
<?php
  }
  ?>
<!-- End friend widget -->
