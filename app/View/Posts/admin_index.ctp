<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-format-list-bulleted menu-icon"></i>                 
		</span>Posts
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
					<th><?php echo $this->Paginator->sort('user_id'); ?></th>
					<th><?php echo $this->Paginator->sort('comment_count'); ?></th>					
					<th class="sort"> <?php echo $this->Paginator->sort('created',' Post Date  '); ?></th>
					<th >
						options
					</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($posts as $post): ?>
					<tr>
						<td > 	<?php echo h($post['Post']['id']); ?> </td>
						<?php if(@$post['Post']['img_thumb1_full_path']){ ?>
							 <td > <img src="<?=($post['Post']['img_thumb1_full_path']); ?>" class="img-responsive" /></td>

					   <?php }else{ ?>
						<td > <img src="http://placehold.it/90x90" class="img-responsive"  /></td>
						
					   <?php } ?>
					   <td > 	<?php echo h($post['Post']['title']); ?> 	</td>
		<td>
			<?php echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
		</td>
		<td><?php echo h($post['Post']['comment_count']); ?>&nbsp;</td>					   
					   <td >    <?php echo h($post['Post']['date']); ?> </td>
						<td >    <?php echo h($post['Post']['created']); ?> </td>
						<td >
						<?php echo $this->Html->link(__('View '),
								array('action' => 'view', $post['Post']['id']),array('escape' => FALSE)); ?>
							<?php echo $this->Html->link(__('Edit'),
								array('action' => 'edit', $post['Post']['id']),array('escape' => FALSE)); ?>
							<?php echo $this->Form->postLink( 'Delete', array( 'action' => 'delete',$post['Post']['id']), array(
                            'confirm'=>'Are you sure you want to delete post?' ) ); ?>

						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?= $this->List->paging();?>
		</div>				  
		  
		 
		</div>
	  </div>
	</div>
