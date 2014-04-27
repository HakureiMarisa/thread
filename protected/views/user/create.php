<?php
$this->breadcrumbs=array(
	'用户管理'=>array('index'),
	'添加',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        添加用户
    </div>
    <div class="panel-body">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>
