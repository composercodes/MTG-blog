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
            <i class="fa fa-key"></i>
            تغير كلمة المرور
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
                    <i class="fa fa-key"></i>
                    تغير كلمة المرور
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

                <?php  echo $this->Form->create('User',array('autocomplete'=>"off", 'action'=>'doctorchpass')); ?>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label">الباسورد	   :</label>
                        <?php echo $this->Form->input('id', array('type'=>"hidden",'value'=>$id,'label' => false,'class' => 'form-control')); ?>

                        <?php echo $this->Form->input('new_password', array('autocomplete'=>"off",'label' => false,'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">اعد كتابة الباسورد	 :</label>
                        <?php echo $this->Form->input('retype_password', array('autocomplete'=>"off",'type'=>'password','label' => false,'class' => 'form-control')); ?>
                    </div>
                    <div class="margin-top-10">
                        <?php echo $this->Form->button(__('<i class="fa fa-check"></i> تغير كلمة المرور'), array('class' => 'btn blue')); ?>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>