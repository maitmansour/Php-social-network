<!-- Author : AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start share new message -->

<form id="post_message_form">
    <div class="row">
        <div class="col-lg-<?php if($context->showOthersProfile==1) {echo " 12 ";}else{echo "8 ";}?>">
            <label for="validationCustom01">Your Message</label>
            <input type="text" class="form-control" id="message_txt" placeholder="Your toughts here !" required>
        </div>
        <?php if($context->showOthersProfile!=1){ ?>

        <div class="col-lg-4">
            <label for="validationCustom05">Tag Someone</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon">@</div>
                <input id="message_tag" type="hidden">
                <input type="text" class="form-control" id="field" placeholder="Username">
            </div>
        </div>
        <?php }else{
                              echo '<input id="message_tag" type="hidden" value="'.$context->userProfile->getId().'">';
                           }?>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <label for="validationCustom04">Image URL</label>
            <input type="text" class="form-control" id="message_img" placeholder="Image Url Here !">
        </div>
        <div class="col-lg-4">
            <label for="validationCustom04">Go !</label>
            <input class="form-control btn btn-primary" type="submit" value="Share">
        </div>
    </div>
</form>
<!-- End share new message -->
