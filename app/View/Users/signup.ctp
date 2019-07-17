 <!-- START SECTION -->
<div class="section">
   <div class="wrapper">
      <div class="login pages account full-padd marg-botm">
         <!-- Page Headline -->
         <div class="headline up-case">
            <div>
               <h3>Sign up</h3>
            </div>
         </div>
         <!-- Page Content -->
         <div class="page-content">  
			<div class="login-wrap">		 
				<?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>

						<div class="form-group">
							<label class="col-md-3 control-label">
							   username  :
							</label>
							<div class="col-md-4">
								
								<?php echo $this->Form->input('username', array('label' => false,'class' => 'full-padd')); ?>

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								name :
							</label>
							<div class="col-md-4">
								<?php echo $this->Form->input('name', array('label' => false,'class' => 'full-padd')); ?>

							</div>
						</div>
						<?php if(empty($this->request->data['User']['id'])){ ?>
						<div class="form-group">
							<label class="col-md-3 control-label">
								password :
							</label>
							<div class="col-md-4">
								<?php echo $this->Form->input('password', array('label' => false,'class' => 'full-padd')); ?>

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">
								retype password :
							</label>
							<div class="col-md-4">
								<?php echo $this->Form->input('retype_password', array('type'=>'password','label' => false,'class' => 'full-padd')); ?>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-md-3 control-label">
								email :
							</label>
							<div class="col-md-4">
								<?php echo $this->Form->input('email', array('type'=>'email','label' => false,'class' => 'full-padd')); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">
								role
							</label>
							<div class="col-md-4">
								<?php echo $this->Form->input('role', array('type'=>'select','label' => false,'class' => 'full-padd')); ?>
							</div>
						</div>


						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-4 col-md-4">
									<?php echo $this->Form->button(__('Sign up Now'),  array('type'=>'submit','class'=>'submit backg-colr up-case','label'=>false,'escape'=>false)); ?>
								</div>
							</div>
						</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>