<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="fa fa-users"></i>
            المستخدمين
        </li>
    </ul>
    <div class="page-toolbar" style="    padding: 1.3px;">
        <div class="btn-group pull-right">
            <a onclick="parent.history.back();"  href="#"class="btn default red-stripe">
                <i class="fa fa-arrow-circle-left"></i>
                <span class="hidden-480"> 	رجوع </span>
            </a>
        </div>
    </div>
</div>
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-users"></i>
					عرض بيانات المستخدمين
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
                    <a href="" class="fullscreen btn-xx" data-original-title="" title=""> 
                    </a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<?php echo $this->Html->link(__	('<i class="fa fa-plus"></i>
أضافة مستخدم جديد
'), array('controller' => 'Users','action' => 'add' ),
									array('escape' => FALSE , 'class'=>'btn green' ,'type' => 'button','label'=>'الغاء')
								); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th style="text-align: center;">
								#
							</th>
							<th style="text-align: center;">
								اسم الدخول
							</th>
							<th style="text-align: center;">
								الاسم بالكامل
							</th>
							<th style="text-align: center;">
								مفعل / غير مفعل
							</th>
							<th style="text-align: center;">
							موبيل
							</th>
							<th style="text-align: center;">
								خيارات
							</th>
						</tr>
						</thead>
						<tbody>
							<?php
                            $i = 1;
                             foreach ($users as $user): ?>
							<tr>
								<td style="text-align: center;">
									    <?= $i ;?>
								</td>
								<td style="text-align: center;">
									<?php echo h($user['User']['username']); ?>
								</td>
								<td style="text-align: center;">
									<?php echo h($user['User']['name']); ?>
								</td>
								<td style="text-align: center;">
									<?php if( h($user['User']['active'])== 1)
									{
										echo "<i class='fa fa-check'></i> مفعل";
									}else
									{
										echo "<i class='fa fa-ban'></i> غير مفعل" ;
									}
									?>
									&nbsp;</td>
								<td style="text-align: center;">
									<?php echo h($user['User']['mobile']); ?>
								</td>
								<td style="text-align: center;">
									<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> &nbsp;عرض '.'/'.'&nbsp;تعديل'),
										array('action' => 'edit', $user['User']['id']),array('class'=>'btn   btn-sm blue','escape' => FALSE)); ?>
 									<?php echo $this->Html->link(__('<i class="fa fa-key"></i  >&nbsp; تغير كلمة المرور '),
										array('controller'=>'users','action' => 'chpass', $user['User']['id']),array('class'=>'btn yellow-crusta  btn-sm ','escape' => FALSE)); ?>
                                    <?php  echo $this->Html->link(__('<i class="fa fa-trash"></i>&nbsp;حذف'),
										array('action' => 'delete', $user['User']['id']),
										array('escape' => FALSE,'data-btn-cancel-label'=>'لا','data-btn-ok-label'=>'نعم','data-popout'=>'true','data-toggle' =>'confirmation','data-singleton'=>'true' ,'data-original-title'=>'هل أنت متأكد ؟ ' ,'class'=>'btn btn-sm red ')); ?>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
						</tbody>
					</table>
                    <?= $this->List->paging();?>
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
