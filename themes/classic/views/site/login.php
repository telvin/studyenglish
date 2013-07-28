<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<section class="post">
    <div id="login_heading">
        <h2>Login</h2>
        <p>Please fill out the following form with your login credentials:</p>
    </div>

    <div id="forgotpw_heading" style="display: none">
        <h2>Forgot Password</h2>
        <p>Enter the e-mail address associated with your account, then click Forgot Password. We'll email you a link to a page where you can easily create a new password</p>
    </div>

    <div class="loginWrapper">
        <!-- Current user form -->
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="loginPic">
            <a href="#" title="Forgot Password" class="logback flip" style="left: 0px; opacity: 1;"></a>

            <a href="#" title="User"><img src="http://i.imgur.com/axskkd0.png" alt=""></a>

            <a title="Reset Form" class="logright" style="right: 0px; opacity: 1;"></a>

        </div>

        <?php echo $form->textField($model,'username', array('class'=>'loginUsername', 'placeholder'=>'Your username')); ?>
        <?php echo $form->error($model,'username'); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'loginPassword', 'placeholder'=>'Password')); ?>
        <?php echo $form->error($model,'password'); ?>

        <div class="logControl">
            <div class="memory">
                <div class="checker" id="uniform-remember2">
                    <span>
                        <input type="checkbox" checked="checked" class="check" id="remember2" style="opacity: 0;">
                        <?php echo $form->checkBox($model,'rememberMe', array('class'=>'check')); ?>
                    </span>
                </div>
                <?php echo $form->label($model,'rememberMe', array('for'=>'remember2')); ?></div>
            <?php echo CHtml::submitButton('Login', array('class'=>'buttonM bBlue')); ?>
        </div>
        <?php $this->endWidget(); ?>

        <!-- New user form -->

        <div class="loginWrapper">
            <!-- Current user form -->
            <?php $form1=$this->beginWidget('CActiveForm', array(
                'id'=>'recover',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
            <div class="loginPic">
                <a href="#" title=""><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/forgot_pwd.jpg" alt=""></a>
                <div class="loginActions">
                    <div><a href="#" title="Login" class="logleft flip" style="left: 0px; opacity: 1;"></a></div>
                    <div><a href="#" title="Reset Form" class="logright" style="right: 0px; opacity: 1;"></a></div>
                </div>
            </div>

            <?php echo $form1->emailField($model2,'email', array('class'=>'loginEmail', 'placeholder'=>'Email')); ?>
            <div class="logControl">
                <?php echo CHtml::submitButton('Forgot Password', array('class'=>'buttonM bBlue')); ?>
            </div>
            <?php $this->endWidget(); ?>

    </div>

    <div class="cl"></div>
</section>