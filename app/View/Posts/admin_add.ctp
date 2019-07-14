  <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>                 
              </span>
                    <?php if(!empty($this->request->data['Post']['id'])){ ?>
                        <i class="fa fa-edit"></i>
                        Edit Post
                    <?php }else{ ?>
                        <i class="icon-plus"></i>
                        Add New Post
                    <?php } ?>
            </h3>
          </div>    

   <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <p class="card-description">
                    <?php if(!empty($this->request->data['Post']['id'])){ ?>
                        <i class="fa fa-edit"></i>
                        Edit Post
                    <?php }else{ ?>
                        <i class="icon-plus"></i>
                        Add New Post
                    <?php } ?>
                  </p>
				  <?php echo $this->Form->create('Post',array('type' => 'file','class'=>'forms-sample')); ?>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
					    <?php echo $this->Form->input('id');?>
                        <?php echo $this->Form->input('title', array('label' => false,'class' => 'form-control')); ?>
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="Image">Image</label>
                                <?php
                                $modelClass = 'Post' ;
                                $field = 'img' ;
                                echo  $this->element('image_input_between', array('info' => $file_settings[$field], 'field' => $field, 'id' => (!empty($this->request->data[$modelClass]['id']) ? $this->data[$modelClass]['id'] : null), 'base_name' => (!empty($this->request->data[$modelClass][$field]) ? $this->request->data[$modelClass][$field] : '')))?>                      
                                <?php echo $this->Form->input('img' , array('div'=>false,'label'=>false,'class' => 'input' , 'type' => 'file'  ) ); ?>                   
					</div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                    
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                      </label>
                    </div>
                    <?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-gradient-primary mr-2')); ?>
					<?php echo $this->Html->link(__	('Cancel'), array( 'action' => 'index' ),array('escape' => FALSE , 'class'=>'btn btn-light' ,'type' => 'button')); ?>					
                  </form>
                </div>
              </div>
            </div>
			</div>

















<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo Router::url(array('controller' => 'home', 'action' => 'admin')); ?>">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="fa fa-globe"></i>
            <a href="<?php echo Router::url(array('controller' => 'Posts', 'action' => 'index')); ?>">Posts    </a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <?php if(!empty($this->request->data['Post']['id'])){ ?>
                <i class="fa fa-edit"></i>
                Edit Post
            <?php }else{ ?>
                <i class="icon-plus"></i>
                Add New Post
            <?php } ?>
        </li>
    </ul>
    <div class="page-toolbar" style="    padding: 1.3px;">
        <div class="btn-group pull-right">
            <a href="#" onclick="history.go(-1);" class="btn default red-stripe">
                <i class="fa fa-arrow-circle-left"></i>
                <span class="hidden-480">	رجوع </span>
            </a>
        </div>
    </div>
</div>
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($this->request->data['Post']['id'])){ ?>
                        <i class="fa fa-edit"></i>
                        Edit Post
                    <?php }else{ ?>
                        <i class="icon-plus"></i>
                        Add New Post
                    <?php } ?>
                </div>

                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <br>
                <?php echo $this->Form->create('Post',array('type' => 'file','class'=>'form-horizontal')); ?>
                <!--<form class="form-horizontal" role="form">-->
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Post Title   :
                        </label>
                        <div class="col-md-8">
                            <?php echo $this->Form->input('id');?>
                            <?php echo $this->Form->input('name', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Post Content    :
                        </label>
                        <div class="col-md-8">
                            <?php echo $this->Form->input('content', array('type' => 'textarea','label' => false,'class' => 'form-control ','id'=>'summernote_1')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Post Image :
                        </label>
                        <div class="col-md-8">
                       <div class="fileinput fileinput-new col-md-8" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php
                                $modelClass = 'Post' ;
                                $field = 'img' ;
                                echo  $this->element('image_input_between_post', array('info' => $file_settings[$field], 'field' => $field, 'id' => (!empty($this->request->data[$modelClass]['id']) ? $this->data[$modelClass]['id'] : null), 'base_name' => (!empty($this->request->data[$modelClass][$field]) ? $this->request->data[$modelClass][$field] : '')))?>

                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                            <div>
																<span class="btn default btn-file">
																<span class="fileinput-new">
																Select image </span>
																<span class="fileinput-exists">
																Change </span>

                                                                    <?php
                                                                    echo $this->Form->input('img' , array('div'=>false,'label'=>false,'class' => 'input' , 'type' => 'file'  ) ); ?>									
                   
																</span>
                                <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                    Remove </a>
                            </div>
                        </div>
                        </div>
                    </div>
                       <div class="form-group">
						<label class="col-md-3 control-label">
							
						</label>

					</div> 
                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <?php echo $this->Form->button(__('<i class="fa fa-check"></i> حفظ'), array('class' => 'btn blue')); ?>

                            <?php echo $this->Html->link(__	('الغاء'), array(
                                    'action' => 'index' ),
                                array('escape' => FALSE , 'class'=>'btn default' ,'type' => 'button','label'=>'الغاء')
                            ); ?>


                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('global/plugins/jquery.min.js'); ?>
<?php echo $this->Html->script('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js');?>