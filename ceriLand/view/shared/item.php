<!-- Author : AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start item listing -->

<?php
                     if (isset($context->messages[0])) {
                         foreach ($context->messages as $message) {
                        if (is_null($message->getEmetteur())||is_null($message->getPost())) {
                           continue;
                        }
                             ?>
    <!-- Item-->
    <div class="item" id="<?=$message->getId()?>">
        <div class="feed d-flex justify-content-between">
            <div class="feed-body d-flex justify-content-between">
                <a href="#" class="feed-profile">
                    <div class="avatar">
                        <img src="<?php  if(!filter_var($message->getEmetteur()->getAvatar(), FILTER_VALIDATE_URL)){ echo $context->unavailable_picture_path;} else {echo $message->getEmetteur()->getAvatar();}?>" alt="person" class="img-fluid rounded-circle" style="height: 50px;">
                    </div>
                </a>
                <div class="content">
                    <h5> <a href="?action=profile&id=<?=$message->getEmetteur()->getId()?>"><?php if ($message->getEmetteur() != null) echo $message->getEmetteur()->getPrenom()." ".$message->getEmetteur()->getNom(); ?> </a>
                        <?php 
                                 if (!is_null($message->getParent())) {
                                    ?>
                        <span> shared (<a href="?action=profile&id=<?=$message->getParent()->getId()?>"><?php echo $message->getParent()->getPrenom()." ".$message->getParent()->getNom(); ?>  </a> ) message ! 
                                 <?php  }
                                    if (is_null($message->getParent())&&!is_null($message->getDestinataire())) 
                                       {  ?>
                                 <span> to (<a href="?action=profile&id=<?=$message->getDestinataire()->getId()?>"><?php echo $message->getDestinataire()->getPrenom()." ".$message->getDestinataire()->getNom(); ?> </a> )
                                 <?php } ?>
                              </h5>
                              <span><?php if ($message->getPost() != null) echo strip_tags($message->getPost()->getTexte()); else echo "Empty post !" ?> 
                              <?php
                                 if(filter_var($message->getPost()->getImage(), FILTER_VALIDATE_URL)){
                                 ?>
                              <img
                                 src="<?=$message->getPost()->getImage()?>"
                                 alt="person" class="img-fluid">
                              <?php
                                 }
                                 ?>
                              </span>
                        <div class="full-date">
                            <small><?php if ($message->getPost() != null) echo $message->getPost()->getDate()." at ". $message->getPost()->getHour(); else echo "Undefined date" ?></small>
                        </div>
                        <div class="CTAs"><a href="ajaxDispatcher.php?action=AddLike&id=<?=$message->getId()?>" class="increase_likes btn btn-xs btn-secondary" value="<?=$message->getId()?>"><i
                                 class="fa fa-thumbs-up"> </i>Like (<span id="likes_counter_<?=$message->getId()?>"><?php echo $message->getAime()==null?0:$message->getAime();?></span>)</a>
                            <a href="ajaxDispatcher.php?action=ShareMessage&id=<?=$message->getId()?>" class="increase_shares  btn btn-xs btn-secondary" value="<?=$message->getId()?>">
                                    <i class="fa fa-share"> </i>
                                    Share 
                                    (<span id="shares_counter_<?=$message->getId()?>"><?php echo postTable::getSharesNumber($message->getPost()->getId());?></span>)
                                 </a>
                        </div>
                </div>
            </div>
            <div class="date text-right">
                <?php
                              $message_date=$message->getPost()->getDate()." ".$message->getPost()->getHour();
                              $date = new DateTime($message->getPost()->getDate()." ".$message->getPost()->getHour());
                              
                              $date = $date->format('Y-m-d H:i:s');
                              ?>
                    <small><?php  echo mainController::timeAgo($date);?></small>
            </div>
        </div>
    </div>
    <?php
                     }
                     }
                     
                     ?>
<!-- End item listing -->
