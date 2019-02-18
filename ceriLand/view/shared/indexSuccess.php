<!-- Author : AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start Index widget -->
<section class="updates">
    <div class="container-fluid">
        <div class="row">
            <!-- Daily Feeds -->
            <div class="col-lg-12">
                <div class="daily-feeds card">
                    <?php include($notifications_view); ?>
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Share somthing !</h3>
                        </div>
                        <div class="card-body">
                            <?php include($share_view); ?>
                        </div>
                    </div>
                    <div class="card-body no-padding" id="messages_content">
                        <!-- items here -->
                        <?php include($item_view); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Index widget -->
