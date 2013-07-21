<?php $this->setPageTitle('Login'); ?>
<div class="row-fluid">
    <div class="span12 center login-header">
        <h2>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h2>
    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="well span5 center login-box">
        <div class="alert alert-info">
            Please login with your Username and Password.
        </div>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions'=>array(
                    'class'=> 'form-horizontal'
                )
            )); ?>
            <fieldset>
                <div class="input-prepend" title="Username" data-rel="tooltip">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <?php echo $form->textField($model,'username', array('autofocus'=>'', 'class'=>'input-large span10')); ?>
                    <?php echo $form->error($model,'username'); ?>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend" title="Password" data-rel="tooltip">
                    <span class="add-on"><i class="icon-lock"></i></span>
                    <?php echo $form->passwordField($model,'password', array('class'=>'input-large span10')); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend">
                    <label class="remember" for="remember">
                    <?php echo $form->checkBox($model,'rememberMe'); ?>Remember me</label>
                    <?php echo $form->error($model,'rememberMe'); ?>
                </div>
                <div class="clearfix"></div>

                <p class="center span5">
                    <button type="submit" class="btn btn-primary">Login</button>
                </p>
            </fieldset>
        <?php $this->endWidget(); ?>
    </div><!--/span-->
</div><!--/row-->
