<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="fa fa-user-md"></i>
            <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'index_doctor')); ?>">بيانات الاطباء    </a>
              <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="fa fa-edit"></i>
            عرض وتعديل بيانات الطبيب
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
        <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">
            <ul class="nav nav-tabs">
                <li class="active" style="    background: #D3DBF2;">
                    <a href="#tab_0" data-toggle="tab" style="font-weight: 900;font-size: 16px;">
                        عرض بيانات الطبيب </a>
                </li>
                <li style="    background: #D3DBF2;">
                    <a href="#tab_1" data-toggle="tab" style="font-weight: 900;font-size: 16px;">
                        تعديل بيانات الطبيب   </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet light bordered  ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-eye"></i>    عرض بيانات <?=$this->request->data['User']['name'] ?>
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

                            <form class="form-horizontal" role="form">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    اسم الدخول :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['username']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    الايميل  :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['email']); ?>
                                                        &nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    الاسم بالكامل   :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['name']); ?>


                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    موبيل  :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['mobile']); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->


                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    تليفون   :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['phone']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    تاريخ الاضافة :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['created']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    مفعل / غير مفعل  :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php if($this->request->data['User']['active'] == 1){ ?>
                                                            <i class="fa fa-check-square" style="font-size: 21px;"></i>
                                                        <?php }else{ ?>
                                                            <i class="fa fa-ban" style="font-size: 21px;"></i>
                                                        <?php }?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">
                                                    تاريخ اخر تعديل :
                                                </label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo h($this->request->data['User']['modified']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered  ">
                                <div class="portlet-title">
                                    <div class="caption">

                                        <i class="fa fa-edit"></i>
                                        تعديل  بيانات  <?=$this->request->data['User']['name'] ?>

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
                                                اسم المستخدم  :
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
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-4">
                                                <?php echo $this->Form->button(__('<i class="fa fa-check"></i> حفظ'), array('class' => 'btn blue')); ?>

                                                <?php echo $this->Html->link(__	('<i class="fa fa-undo"></i>  الغاء'), array(
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
            </div>
        </div>
    </div>