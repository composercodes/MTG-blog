 <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>                 
              </span>
              Posts
            </h3>

          </div>      

	   <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-description">
				  <?php echo $this->Html->link(__	(' <i class="mdi mdi-plus"></i> Add New Post'), array('action' => 'add' ),	array('escape' => FALSE , 'class'=>'btn btn-info btn-fw' ,'type' => 'button')); ?>
                   
                  </p>
				  
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="checkers">
                        <thead>
                        <tr>
                            <th class="sort"> <?php echo $this->Paginator->sort('id','#'); ?></th>
                            <th class="sort"> <?php echo $this->Paginator->sort('img','Post Image '); ?></th>
                            <th class="sort"> <?php echo $this->Paginator->sort('name','Post Title '); ?></th>
                            <th class="sort"> <?php echo $this->Paginator->sort('created',' Post Date  '); ?></th>
                            <th style="text-align: center;">
                                options
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td style="text-align: center;"> 	<?php echo h($post['Post']['id']); ?> </td>
                                <?php if($post['Post']['type'] == 0){ ?>
                                     <td style="text-align: center;"> <img src="<?=($post['Post']['img_thumb1_full_path']); ?>" class="img-responsive" style="width:200px;" /></td>
                                
                               <?php }else{ ?>
                                <td style="text-align: center;"> <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQ-tVXvJkVWB6DQwc-0uHDlEcO_59jeimNKLznor8wuAwsxn1EU" class="img-responsive" style="width:200px;" /></td>
                                
                               <?php } ?>
                               <td style="text-align: center;"> 	<?php echo h($post['Post']['title']); ?> 	</td>
                                <td style="text-align: center;">    <?php echo h($post['Post']['created']); ?> </td>
                                <td style="text-align: center;">
                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i  >'.'&nbsp;View / Edit'),
                                        array('action' => 'edit', $post['Post']['id']),array('class'=>'btn blue btnn btn-xs ','escape' => FALSE)); ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-trash"></i>&nbsp;Delete'),
                                        array('action' => 'delete', $post['Post']['id']),
                                        array('class'=>'btn default btnn btn-xs red','escape' => FALSE ,'data-popout'=>'true','data-toggle' =>'confirmation')); ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>				  
				  
                 
                </div>
              </div>
            </div>
