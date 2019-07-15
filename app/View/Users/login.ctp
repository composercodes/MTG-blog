        <!-- START SECTION -->
            <div class="section">
                <div class="wrapper">    
			<div class="login pages account full-padd marg-botm">
                        <!-- Page Headline -->
                        <div class="headline up-case">
                            <div><h3>Sign in</h3></div>
                        </div>
                        <!-- Page Content -->
                        <div class="page-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <!-- Login Form -->
                            <div class="login-wrap">
							    <?php echo $this->Form->create(array('class'=>'full-padd form','url'=>array('controller'=>'users','action'=>'login'))); ?>

                                    <div class="form-row">
									    <?php echo $this->Form->input('username',array('class'=>'full-padd  placeholder-no-fix', 'autocomplete'=>'off' , 'placeholder'=> 'User Name','label'=>false,'escape'=>false,'div'=>false)); ?>
                                       
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-row">
									      <?php echo $this->Form->input('password',array('class'=>'full-padd', 'autocomplete'=>'off' , 'placeholder'=> 'Password','label'=>false ,'div'=>false)); ?>
                                        
                                        <i class="fa fa-unlock-alt"></i>
                                    </div>
                                    <div class="sign-opti form-row">
                                        <div class="remember checkbox">
                                            <label>
                                                <input type="checkbox" checked>Remember Me
                                            </label>
                                        </div>
                                        <div class="forgt-not">
                                          
                                            <a href="register.html">- You are not a member?</a>
                                        </div>
										        <?php echo $this->Form->button(__('Sign in Now'),  array('type'=>'submit','class'=>'submit backg-colr up-case','label'=>false,'escape'=>false)); ?>
                                      
                                    </div>
                                    <!-- Login With Social -->
  
                                </form>
                                <div class="forgot form-row full-padd">
                                    <i class="form-close fa fa-close"></i>
                                    <p>
                                        Lost your password? Please enter your email address.
                                        You will receive a link to create a new password.
                                    </p>
                                    <form action="#">
                                        <div class="form-row">
                                            <input class="full-padd" type="email" placeholder="Enter Your E-mail Address">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="form-row">
                                            <input class="submit backg-colr up-case" type="submit" value="Reset Password">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
                    </div>					
	
	