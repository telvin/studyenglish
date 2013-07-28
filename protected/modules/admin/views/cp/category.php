<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Category</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Basic Info</h2>

            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'category-category-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'class' => 'form-horizontal'
                )
            )); ?>

            <fieldset>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'name', array('class' => 'input-xlarge focused')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'priority', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'name', array('class' => 'input-xlarge focused')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'color_code', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php $this->widget('ext.widgets.colorpicker.ColorPicker', array(
                            'model'=>$model,
                            'attribute' => 'color_code',
                            //'name' => 'color_code',
                            'configOpts' => array(
                                'type' => 'hidden', // or textbox,
                                'defaultColor' => 'c3c3c3',
                                'container_id' => '' // just available for type hidden default empty
                            ),
                            'htmlOptions' => array(
                                'class'=> 'input-xlarge focused'
                            ),
                            'jsOpts' => array( // Configuration Object for JS
                            )
                        )); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textArea($model, 'description', array('class' => 'cleditor')); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php $this->endWidget(); ?>

        </div>
    </div>
    <!--/span-->

</div><!--/row-->