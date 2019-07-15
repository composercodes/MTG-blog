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
                      <label for="title">Title</label>
					    <?php echo $this->Form->input('id');?>
                        <?php echo $this->Form->input('title', array('label' => false,'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                      <label for="content">content</label>					
						<?php

		echo $this->Form->input('content', array('label' => false,'class' => 'form-control'));
	

	?> </div>
                     <div class="form-group">
                      <label for="date">date</label>	
					 		<?php

		echo $this->Form->input('date', array('label' => false,'class' => 'form-control'));

	?> 
					   </div>
					                     

 <div class="form-group">
                      <label for="Image">Image</label>
                                <?php
                                $modelClass = 'Post' ;
                                $field = 'img' ;
                                echo  $this->element('image_input_between', array('info' => $file_settings[$field], 'field' => $field, 'id' => (!empty($this->request->data[$modelClass]['id']) ? $this->data[$modelClass]['id'] : null), 'base_name' => (!empty($this->request->data[$modelClass][$field]) ? $this->request->data[$modelClass][$field] : '')))?>                      
                                <?php echo $this->Form->input('img' , array('div'=>false,'label'=>false,'class' => 'input' , 'type' => 'file'  ) ); ?>                   
					</div>

                    <?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-gradient-primary mr-2')); ?>
					<?php echo $this->Html->link(__	('Cancel'), array( 'action' => 'index' ),array('escape' => FALSE , 'class'=>'btn btn-light' ,'type' => 'button')); ?>					
                  </form>
                </div>
              </div>
            </div>
			</div>





