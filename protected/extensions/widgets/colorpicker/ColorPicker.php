<?php

/**
 * ColorPicker class file.
 *
 * The color picker widget is implemented based this jQuery plugin:
 * (see {@link https://github.com/laktek/really-simple-color-picker}).
 *
 * This widget is more useful as a textfield (the default mode)
 *
 * @author Tonin De Rosso Bolzan <admin@tonybolzan.com>
 * @package ext.colorpicker
 * @version 1.0
 */
class ColorPicker extends CInputWidget {

    public $assets = 'assets';
    public $configOpts = array(
        'container_id' => '',
        'type'=> 'hidden',
        'defaultColor' => '00ff00'
    );
    public $jsOpts = array();

    public function run() {
        list($name, $id) = $this->resolveNameID();

        $this->htmlOptions['id'] = $id;
        $this->htmlOptions['name'] = $name;
        $this->htmlOptions['size'] = !isset($this->htmlOptions['size']) ? 6 : $this->htmlOptions['size'];
        $this->htmlOptions['maxlength'] = !isset($this->htmlOptions['maxlength']) ? 6 : $this->htmlOptions['maxlength'];

        $jsOptions = CJavaScript::encode($this->jsOpts);

        $type = $this->configOpts['type'];
        $defaultColor = $this->configOpts['defaultColor'];
        $container_id =  $this->configOpts['container_id'];

        if($type == 'textbox'){

            //$id = __CLASS__ . '#' . $this->htmlOptions['id'];
            //$id = $this->htmlOptions['id'];
            if ($this->hasModel()) {
                echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
            } else {
                echo CHtml::textField($name, $this->value, $this->htmlOptions);
            }
        }else{
            $id = empty($container_id) ? $id.'_container' : $container_id;

            if ($this->hasModel())
                if(!empty($this->model[$this->attribute]))
                    $defaultColor = !empty($this->model[$this->attribute]) ?  $this->model[$this->attribute] : $defaultColor;

            echo
                '<div class="colorpicker-widget">
                       <div id="'.$id.'" class="colorpicker-widget-panel">
                        <div style="background-color: #'.$defaultColor.'"></div>
                    </div>
                </div>';

            if ($this->hasModel()) {
                echo CHtml::activeHiddenField($this->model, $this->attribute, $this->htmlOptions);
            } else {

                echo CHtml::hiddenField($name, $this->value, $this->htmlOptions);
            }
        }


        $this->registerScripts($id, $jsOptions, $type);
    }

    protected function registerScripts($id, $js, $type='hidden') {
//        $registerJs[] = YII_DEBUG ? 'jquery.colorPicker.js' : 'jquery.colorPicker.min.js';

        $registerJs[] = 'colorpicker.js';
        $registerCss[] = 'colorpicker.css';

        $defaultJsOptions = <<<EOT
         {
        onSubmit: function(hsb, hex, rgb) {
				$("#{$id} div").css("backgroundColor", "#" + hex);
				$("#{$this->htmlOptions['id']}").val(hex);

			}
        }
EOT;


        if($type == 'textbox'){
            $defaultJsOptions = '{
        onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
        }';
        }


        if($js == '[]')
            $js = $defaultJsOptions;
        $script[] = "$('#{$id}').ColorPicker($js);";

        $basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->assets . DIRECTORY_SEPARATOR;
        $baseUrl = Yii::app()->assetManager->publish($basePath, false, 1, YII_DEBUG);

        $cs = Yii::app()->clientScript;

        foreach ($registerJs as $file) {
            $cs->registerScriptFile("$baseUrl/js/$file", CClientScript::POS_END);
        }
        foreach ($registerCss as $file) {
            $cs->registerCssFile("$baseUrl/css/$file");
        }


//        $cs->registerCoreScript('jquery');
        $cs->registerScript($id, implode('', $script), CClientScript::POS_READY);
    }
}