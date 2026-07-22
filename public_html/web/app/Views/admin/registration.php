<main>
   <!-- ======= About Section ======= -->
   <section class="contactus-details-section section-bottom">
      <div class="container" data-aos="fade-in">
         <div class="row justify-content-center">
            <div class="col-lg-6 content justify-content-center bg-2 p-4" data-aos="fade-up" data-aos-delay="100">
               <h3 class="title text-center"><?php echo ($type == 'agent') ? 'Agent' : ''; ?> Register</h3>
               <?php 
                  $attributes = 'name="registration" id="registration_form" class="registration" enctype="multipart/form-data"';
                  $hidden     = array();
                  if($type == 'agent'){
                      echo form_open(route_to('agent_registration_url'), $attributes, $hidden);
                  } else {
                      echo form_open(route_to('registration_url'), $attributes, $hidden);
                  } ?>
               <div class="row traveller-form">
                  <div class="form-group col-md-12">
                     <label for="register_first_name">First Name <?php echo astrik(); ?></label>
                     <input type="text" id="register_first_name" class="form-control grey-control" name="first_name" value="<?= set_value('first_name') ?>" placeholder="First Name" />
                     <?php echo (isset($validation) && $validation->getError('first_name') != '') ? '<label class="error">'.$validation->getError('first_name').'</label>' : '' ?>
                  </div>
                  <div class="form-group col-md-12">
                     <label for="register_last_name">Last Name <?php echo astrik(); ?></label>
                     <input type="text" id="register_last_name" class="form-control grey-control" name="last_name" value="<?= set_value('last_name') ?>" placeholder="Last Name" />
                     <?php echo (isset($validation) && $validation->getError('last_name') != '') ? '<label class="error">'.$validation->getError('last_name').'</label>' : '' ?>
                  </div>
                  <div class="form-group col-md-12">
                     <label for="register_email">Email Address <?php echo astrik(); ?></label>
                     <input type="email" id="register_email" class="form-control grey-control" name="email" value="<?= set_value('email') ?>" placeholder="Email Address" />
                     <?php echo (isset($validation) && $validation->getError('email') != '') ? '<label class="error">'.$validation->getError('email').'</label>' : '' ?>
                  </div>
                  <div class="form-group col-md-12">
                     <label for="register_mobile_number">Mobile Number <?php echo astrik(); ?></label>
                     <input type="text" id="register_mobile_number" class="form-control grey-control" name="mobile_number" value="<?= set_value('mobile_number') ?>" placeholder="Mobile Number" />
                     <?php echo (isset($validation) && $validation->getError('mobile_number') != '') ? '<label class="error">'.$validation->getError('mobile_number').'</label>' : '' ?>
                  </div>
                  <div class="form-group col-md-12">
                     <label for="register_password">Password <?php echo astrik(); ?></label>
                     <input type="password" id="register_password" class="form-control grey-control" name="password" placeholder="Password" />
                     <?php echo (isset($validation) && $validation->getError('password') != '') ? '<label class="error">'.$validation->getError('password').'</label>' : '' ?>
                  </div>
                  <div class="form-group col-md-12">
                     <label for="register_c_password">Confirm Password <?php echo astrik(); ?></label>
                     <input type="password" id="register_c_password" class="form-control grey-control" name="confirm_password" placeholder="Confirm Password" />
                     <?php echo (isset($validation) && $validation->getError('confirm_password') != '') ? '<label class="error">'.$validation->getError('confirm_password').'</label>' : '' ?>
                  </div>
                  <!-- <div class="form-group col-md-12">
                     <div class="custom02">
                         <div class="checkbox d-flex">
                             <input type="checkbox" id="is_agent" name="is_agent" value="1" />
                             <label for="is_agent">Agent</label>
                         </div>
                     </div>
                     </div> -->
                  <div class="form-group col-md-12 mb-0">
                     <input type="submit" class="btn btn-primary" name="save" value="Register" />
                  </div>
               </div>
               <?php echo form_close(); ?>
               <div class="d-flex justify-content-between">
                  <?php
                     if($type == 'agent'){
                         echo '<span>Already registered? '.anchor(route_to('agent_login_url'), 'Login here', 'title="Login here"').'</span>';
                     } else {
                         echo '<span>Already registered? '.anchor(route_to('login_url'), 'Login here', 'title="Login here"').'</span>';
                     } ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
<!-- End #main -->