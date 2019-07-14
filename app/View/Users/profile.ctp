<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <i class="icon-settings"></i>
            البيانات الشخصية
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
<!-- BEGIN PAGE CONTENT-->
<div class="row ">
    <div class="col-md-12">
        <?php echo $this->element('profile_sidebar'); ?>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">البيانات الشخصية</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">تعديل البيانات الشخصية</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">تغير الصورة</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">تغير الباسورد </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <?php echo $this->Form->create('User',array('controller'=>'users','action'=>'edit_prfile')); ?>
                                    <div class="form-group">
                                        <label class="control-label">اسم الدخول : </label>
                                        <?php echo $this->Form->input('username', array('value'=>$user_data['User']['username'],'label' => false,'class' => 'form-control')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">الاسم بالكامل :</label>
                                        <?php echo $this->Form->input('name', array('value'=>$user_data['User']['name'],'label' => false,'class' => 'form-control')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">التخصص :</label>
                                        <?php echo $this->Form->input('specialty', array('value'=>$user_data['User']['specialty'],'type'=>'text','label' => false,'class' => 'form-control')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">الايميل :</label>
                                        <?php echo $this->Form->input('email', array('value'=>$user_data['User']['email'],'type'=>'text','label' => false,'class' => 'form-control')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">رقم الموبيل :</label>
                                        <?php echo $this->Form->input('mobile', array('value'=>$user_data['User']['mobile'],'type'=>'text','label' => false,'class' => 'form-control')); ?>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">رقم التليفون :</label>
                                        <?php echo $this->Form->input('phone', array('value'=>$user_data['User']['phone'],'type'=>'text','label' => false,'class' => 'form-control')); ?>

                                    </div>
                                    <div class="margiv-top-10">
                                        <button type="submit" class="btn blue">
                                            <i class="fa fa-check"></i> حفظ التغيرات  </button>
                                    </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <?php echo $this->Form->create('User',array('action'=>'avatar','class'=>'form-horizontal form-row-seperated', 'type' => 'file')); ?>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php if($user_data['User']['img']){ ?>
                                                    <img src="<?php echo $this->webroot. 'profile_photos/'.$user_data['User']['img'] ;?>"class="img-responsive"  alt=""/>
                                                <?php }else{ ?>
                                                    <img src="<?php echo $this->webroot. 'img/doc.png';?>"class="img-responsive"  alt=""/>
                                                <?php } ?>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
																<span class="btn default btn-file">
																<span class="fileinput-new">
																اختر الصورة</span>
																<span class="fileinput-exists">
																تغير </span>
																<input type="file" name="photo">
																</span>
                                                <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                    ازالة </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margin-top-10">
                                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> حفظ الصورة</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <?php  echo $this->Form->create('User',array('autocomplete'=>"off",'controller'=>'users', 'action'=>'chpass_prfile')); ?>

                                    <div class="form-group">
                                        <label class="control-label">الباسورد	   :</label>
                                        <?php echo $this->Form->input('new_password', array('autocomplete'=>"off",'label' => false,'class' => 'form-control')); ?>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">اعد كتابة الباسورد	 :</label>
                                        <?php echo $this->Form->input('retype_password', array('autocomplete'=>"off",'type'=>'password','label' => false,'class' => 'form-control')); ?>
                                    </div>
                                    <div class="margin-top-10">
                                        <?php echo $this->Form->button(__('<i class="fa fa-check"></i> تغير كلمة المرور'), array('class' => 'btn blue')); ?>

                                    </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->

                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE CONTENT-->
<?php echo $this->Html->script('global/plugins/jquery.min.js'); ?>
<?php echo $this->Html->script('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js');?>