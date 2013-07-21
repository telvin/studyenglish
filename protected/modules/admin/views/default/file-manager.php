
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">File Manager</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> File Manager</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="icon-info-sign"></i> As its a demo, you currently have read-only permission, in your server you may do everything like, upload or delete. It will work on a server only.
            </div>
            <!--            <div class="file-manager"></div>-->

            <?php
            //ServerFileInput - use this widget to choose file on server using ElFinder pop-up
            /*
            $this->widget('ext.elFinder.ServerFileInput', array(
                    'model' => $model,
                    'attribute' => 'serverFile',
                    'connectorRoute' => 'admin/elfinder/connector',
                )
            );
            */

            // ElFinder widget - use this widget to manage files
            $this->widget('ext.elFinder.ElFinderWidget', array(
                    'connectorRoute' => 'admin/elfinder/connector',
                )
            );


            /*
            $this->widget('ext.tinymce.TinyMce', array(
                'model' => $model,
                'attribute' => 'tinyMceArea',
                // Optional config
                'compressorRoute' => 'tinyMce/compressor',
                //'spellcheckerUrl' => array('tinyMce/spellchecker'),
                // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
                'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
                'fileManager' => array(
                    'class' => 'ext.elFinder.TinyMceElFinder',
                    'connectorRoute'=>'admin/elfinder/connector',
                ),
                'htmlOptions' => array(
                    'rows' => 6,
                    'cols' => 60,
                ),
            ));

            */

            ?>
        </div>
    </div><!--/span-->

</div><!--/row-->

