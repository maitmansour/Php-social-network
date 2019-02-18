<!-- Author : BELGHARBI Meryem/AIT MANSOUR Mohamed / Reflexion et débogage en binôme-->
<!-- Start login -->
<div class="page login-page">
   <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
         <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
               <div class="info d-flex align-items-center">
                  <div class="content">
                     <div class="logo">
                        <h1>Login</h1>
                     </div>
                     <p>Enter your Login And Password to access to CeriLand !</p>
                  </div>
               </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
               <div class="form d-flex align-items-center">
                  <div class="content">

                <?php include($notifications_view); ?>
   
                     <form id="login-form" method="POST">
                        <div class="form-group">
                           <input id="login-username" type="text" name="login" required="" class="input-material">
                           <label for="login-username" class="label-material">User Name</label>
                        </div>
                        <div class="form-group">
                           <input id="login-password" type="password" name="password" required="" class="input-material">
                           <label for="login-password" class="label-material">Password</label>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Login">
                        <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                     </form>
                     <a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="#" class="signup">Signup</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End login -->
