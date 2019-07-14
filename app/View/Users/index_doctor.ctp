<form  method="post"  action="<?php echo Router::url(array( 'action' => 'change_doctor_status' )); ?>" >
    <!-- BEGIN PAGE HEADER-->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo Router::url(array('controller' => 'home', 'action' => 'admin')); ?>">الرئيسية</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <i class="fa fa-user-md"></i>
                بيانات الاطباء
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
    <!-- END PAGE HEADER-->
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user-md"></i>
                        عرض بيانات الاطباء
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
                    <div class="actions">
                        <div class="btn-group">
                            <a class="btn btn-sm btn btn-sm default " href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i> التحكم
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <button style="border: 0px ;" class="form-control linkButton" type="submit" name="active"><i class="fa fa-check"></i> تفعيل</button>
                                </li>
                                <li>
                                    <button style="border: 0px ;" class="form-control linkButton" type="submit" name="deactive"><i class="fa fa-ban"></i> تعطيل</button>
                                </li>
                                <li>
                                    <button style="border: 0px ;" class="form-control linkButton" type="submit" name="delete"><i class="fa fa-trash-o"></i> حذف  </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <?php echo $this->Html->link(__	('<i class="fa fa-plus"></i>
أضافة طبيب جديد
'), array('controller' => 'Users','action' => 'add_doctor' ),
                                        array('escape' => FALSE , 'class'=>'btn green' ,'type' => 'button','label'=>'الغاء')
                                    ); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="checkers">
                            <thead>
                            <tr>
                                <th class="sort" style="width:8px;"><input  type="checkbox" class="group-checkable" data-set="#checkers .checkboxes" /></th>
                                <th class="sort"> <?php echo $this->Paginator->sort('id','#'); ?></th>
                                <th class="sort"> <?php echo $this->Paginator->sort('username','اسم الدخول'); ?></th>
                                <th class="sort"> <?php echo $this->Paginator->sort('name','اسم الطبيب'); ?></th>
                                <th class="sort"> <?php echo $this->Paginator->sort('active','	مفعل / غير مفعل'); ?></th>
                                <th class="sort"> <?php echo $this->Paginator->sort('mobile','موبيل'); ?> </th>
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
                                    <td><input type="checkbox"  name="ids[]"  class="checkboxes" value="<?= $user['User']['id'] ?>" /></td>
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
                                            echo "<i class='fa fa-minus-circle'></i> غير مفعل" ;
                                        }
                                        ?>
                                        &nbsp;</td>
                                    <td style="text-align: center;">
                                        <?php echo h($user['User']['mobile']); ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $this->Html->link(__('<i class="fa fa-eye"></i  >&nbsp;عرض '.'/'.'&nbsp;تعديل'),
                                            array('action' => 'edit_doctor', $user['User']['id']),array('class'=>'btn default  btn-sm blue','escape' => FALSE)); ?>
                                        <?php echo $this->Html->link(__('<i class="fa fa-key"></i  >&nbsp; تغير كلمة المرور '),
                                            array('action' => 'doctorchpass', $user['User']['id']),array('class'=>'btn yellow-crusta  btn-sm ','escape' => FALSE)); ?>
                                        <?php  echo $this->Html->link(__('<i class="fa fa-trash"></i>&nbsp;حذف'),
                                            array('action' => 'delete_doctor', $user['User']['id']),
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
