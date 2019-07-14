<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Dentalyzer | Dashboard Login Area</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php
    echo $this->Html->css('global/plugins/font-awesome/css/font-awesome.min.css');
    echo $this->Html->css('global/plugins/simple-line-icons/simple-line-icons.min.css');
    echo $this->Html->css('global/plugins/bootstrap/css/bootstrap-rtl.min.css');
    echo $this->Html->css('global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css');
    ?>
    <?php
    echo $this->Html->css('global/css/components-rounded-rtl.min.css');
    echo $this->Html->css('global/css/plugins-rtl.min.css');
    echo $this->Html->css('pages/css/login-rtl.min.css');
    ?>
    <style>
        [class^="fa-"]:not(.fa-stack), [class^="glyphicon-"], [class^="icon-"], [class*=" fa-"]:not(.fa-stack), [class*=" glyphicon-"], [class*=" icon-"] {
            display: inline-block;
            line-height: 20px !important;
            -webkit-font-smoothing: antialiased;
        }.login .content .form-actions {
             clear: both;
             border: 0;
             border-bottom: 0px solid #eee !important;
             padding: 0px 30px !important;
             margin-right: -30px;
             margin-left: -30px;
         }.login-options {
              margin-top: 87px !important;
              margin-bottom: 30px;
              overflow: hidden;
          }
    </style>
    <!-- END THEME STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="<?= $this->webroot; ?>img/icon.png" />
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo" style="margin: 25px auto 0;">
    <a href="<?php echo Router::url('/login'); ?>">
        <?php echo $this->Html->image('login_logo.png', array('class' => 'logo-default','style'=>'margin-right: 16px;width: 303px;'));?>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content" style="    margin: 0px auto 10px;">
    <!-- BEGIN LOGIN FORM -->
    <?php echo $this->Form->create(array('class'=>'login-form','url'=>array('controller'=>'users','action'=>'login'))); ?>
    <h3 style="    font-size: 23px;" class="form-title font-green">تسجيل الدخول للحساب </h3>
    <?php
    if(($this->Session->check('Message.flash'))){ ?>
        <div class="alert alert-danger ">
            <button class="close" data-close="alert"></button>
			<span>
        <?php echo $this->Session->flash(); ?> </span>
        </div>
    <?php } ?>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">اسم المستخدم</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <?php echo $this->Form->input('username',array('class'=>'form-control  placeholder-no-fix'
            , 'autocomplete'=>'off' , 'placeholder'=> 'اسم المستخدم','label'=>false,'escape'=>false,'div'=>false)); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <?php echo $this->Form->input('password',array('class'=>'form-control form-control-solid placeholder-no-fix'
            , 'autocomplete'=>'off' , 'placeholder'=> 'كلمة المرور','label'=>false ,'div'=>false)); ?>
        </div></div>
    <div class="form-actions">

        <?php echo $this->Form->button(__('<i class="fa fa-sign-in"></i>
تسجيل الدخول 
'),
            array('type'=>'submit','class'=>'btn blue pull-left','label'=>false,'escape'=>false)); ?>

    </div>
    <div class="login-options">
        <h4>تواصل معنا :</h4>
        <ul class="social-icons">
            <li>
                <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
            </li>
        </ul>
    </div>
    <div class="create-account">
        <p>
            <a href="javascript:;" id="forget-password" class="uppercase">لمزيد من المعلومات ... </a>
        </p>
    </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="index.html" method="post">
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<div class="copyright">   Dentalyzer © Dental Clinic Managment System</div>
<!--[if lt IE 9]>

<?php echo $this->Html->script('global/plugins/respond.min.js'); ?>
<?php echo $this->Html->script('global/plugins/excanvas.min.js'); ?>
<![endif]-->
<?php echo $this->Html->script('global/plugins/jquery.min.js'); ?>
<?php echo $this->Html->script('global/plugins/bootstrap/js/bootstrap.min.js'); ?>
<?php echo $this->Html->script('global/plugins/js.cookie.min.js'); ?>
<?php echo $this->Html->script('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>
<?php echo $this->Html->script('global/plugins/jquery.blockui.min.js'); ?>
<?php echo $this->Html->script('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
<?php echo $this->Html->script('global/plugins/jquery-validation/js/additional-methods.min.js'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('global/scripts/app.min.js'); ?>
<?php echo $this->Html->script('pages/scripts/login.min.js'); ?>
</body>
</html>