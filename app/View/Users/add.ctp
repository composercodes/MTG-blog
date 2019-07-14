<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="fa fa-users"></i>
            <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'index')); ?>">بيانات المستخدمين    </a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <?php if(!empty($this->request->data['User']['id'])){ ?>
                <i class="fa fa-edit"></i>
                تعديل مستخدم
            <?php }else{ ?>
                <i class="icon-plus"></i>
                أضافة مستخدم جديد
            <?php } ?>
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
        <div class="portlet box blue ">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($this->request->data['User']['id'])){ ?>
                        <i class="fa fa-edit"></i>
                        تعديل <?=$this->request->data['User']['name'] ?>
                    <?php }else{ ?>
                        <i class="icon-plus"></i>
                        أضافة مستخدم جديد
                    <?php } ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="fullscreen btn-xx" data-original-title="" title="">
                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <br>
                <?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
                <!--<form class="form-horizontal" role="form">-->
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            اسم الدخول  :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('id', array('label' => false,'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('username', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            الاسم بالكامل :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('name', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            الباسورد :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('password', array('label' => false,'class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            أعد كتابة الباسورد :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('retype_password', array('type'=>'password','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            الايميل :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('email', array('type'=>'email','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            موبيل :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('mobile', array('type'=>'text','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            تليفون :
                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('phone', array('type'=>'text','label' => false,'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">

                        </label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('active', array('type'=>'checkbox','label' => 'مفعل / غير مفعل','class' => 'form-control')); ?>
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <?php echo $this->Form->button(__('<i class="fa fa-check"></i> حفظ'), array('class' => 'btn blue')); ?>

                                <?php echo $this->Html->link(__	('<i class="fa fa-undo"></i> الغاء'), array(
                                        'action' => 'index' ),
                                    array('escape' => FALSE , 'class'=>'btn grey-cascade' ,'type' => 'button','label'=>'الغاء')
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