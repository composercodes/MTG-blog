<!-- Start Section7 -->
<div class="section7 marg-botm row-main">
	<div class="headline up-case">
		<h3>Latest Posts</h3>
		<a href="<?php echo Router::url('/Posts');?>">See More</a>
	</div>
	<?php foreach ($posts as $post): ?>
	<div class="sec-content main-padd">
		<div class="post-img">
			<div>
				<img src="<?=($post['Post']['img_full_path']); ?>" alt="<?=($post['Post']['title']); ?>">
			</div>
		</div>
		<div class="post">
			<div>
				<h2 class="post-title"><a href="<?php echo Router::url(array('controller'=>'Posts','action'=>'view',$post['Post']['id']));?>"><?=($post['Post']['title']); ?></a></h2>
				<p class="post-body">
					<?=($post['Post']['content']); ?>
				</p>
				<span class="post-info up-case">
					<span class="p-writer">
						<a href="#"><i class="fa fa-user"></i><?=($post['User']['name']); ?></a>
					</span>
					<span class="p-date">
						<a href="#"><i class="fa fa-clock-o"></i>January 31, 2017</a>
					</span>
					<span class="p-comments">
						<a href="#"><i class="fa fa-comments"></i><?=($post['Post']['comment_count']); ?> Comments</a>
					</span>
				</span>
				<a class="post-r-more up-case backg-colr" href="<?php echo Router::url(array('controller'=>'Posts','action'=>'view',$post['Post']['id']));?>">Read More</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<!-- End Section7 -->
                            

