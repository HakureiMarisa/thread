<?php
$this->breadcrumbs=array(
	'用户管理'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新',
);

	$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array('admin')),
	);
	?>

<div class="panel panel-default">
    <div class="panel-heading">
        更新用户 #<?php echo $model->id; ?>
    </div>
    <div class="panel-body">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>