<!-- Author : BELGHARBI Meryem & AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start of Client Profile -->

<div class="col-lg-12">
    <div class="client card">
        <div class="card-body text-center">
            <div class="client-avatar" data-toggle="tooltip" title="Click on image to change it !">
                <img src="<?=$context->userProfile->getAvatar()?>" alt="..." class="img-fluid rounded-circle" id="profile-image">
            </div>
            <div class="client-title">
                <?php if($context->showOthersProfile!=1){ ?>
                <i id="edit_avatar" class="fa fa-pencil fa-lg"></i>
                <span contenteditable="false"><b id="user_avatar" ><?=$context->userProfile->getAvatar()?></b>
 </span>

                <?php } ?>
                <h3>
                    <?=$context->userProfile->getPrenom()?>
                        <?=$context->userProfile->getNom()?>
                </h3>
                <span contenteditable="false"><b id="user_status" ><?=$context->userProfile->getStatut()?></b>
   <?php if($context->showOthersProfile!=1){ ?>
   <i id="edit_status" class="fa fa-pencil fa-lg"></i> 
   <?php } ?>
 </span>

            </div>
            <div class="client-info">
                <table style="width:100%">
                    <tbody>
                        <tr>
                            <td class=" btn btn-primary" onclick="wall()" style="width:45%;text-align:center;cursor:pointer;margin-right: 10px">
                                <font size="6">Wall</font>
                            </td>
                            <td class=" btn btn-info" onclick="friends()" style="width:45%;text-align:center;margin-left: 10px;cursor:pointer">
                                <font size="6">Friends</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Publish status-->
    <div class="card" id="wallDiv" style="display: block">
        <div class="daily-feeds card">
            <!-- Publish status-->
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Share somthing !</h3>
                </div>
                <div class="card-body">
                    <?php include($share_view); ?>
                </div>
            </div>
            <div class="card-body no-padding">
                <!-- items here -->
                <?php include($item_view); ?>
            </div>
        </div>
    </div>

    <div style="display: none" id="friendsDiv" class="row">

        <?php include($friends_view); ?>

    </div>

</div>
<!-- End of Client Profile -->





<?php

if ($context->showOthersProfile!=1) {
  ?>
    <style type="text/css">
        #edit_status:hover {
            color: #FF0000;
        }
    </style>
<script src="js/ceriLand/logged_profile.js" type="text/javascript" ></script>
    <?php
}
?>
