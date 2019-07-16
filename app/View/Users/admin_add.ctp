<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue ">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($this->request->data['User']['id'])){ ?>
                        <i class="fa fa-edit"></i>
                        Edit <?=$this->request->data['User']['name'] ?>
                    <?php }else{ ?>
                        <i class="icon-plus"></i>
                        Add New User
                    <?php } ?>
                </div>
            </div>
            <div class="portlet-body form">
                <br>
                <?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
                <!--<form class="form-horizontal" role="form">-->
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                           username  :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('id', array('label' => false,'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('username', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            name :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('name', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
					<?php if(empty($this->request->data['User']['id'])){ ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            password :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('password', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            retype password :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('retype_password', array('type'=>'password','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>
					<?php } ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            email :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('email', array('type'=>'email','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
							role
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('role', array('type'=>'select','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <?php echo $this->Form->button(__('<i class="fa fa-check"></i> Save'), array('class' => 'btn blue')); ?>

                                <?php echo $this->Html->link(__	('<i class="fa fa-undo"></i> Cancel'), array(
                                        'action' => 'index' ),
                                    array('escape' => FALSE , 'class'=>'btn grey-cascade' ,'type' => 'button','label'=>'Cancel')
                                ); ?>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>