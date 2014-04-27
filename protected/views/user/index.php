<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
                    用户管理
         <div class="pull-right"><?php echo CHtml::link('添加', array('/user/create'))?></div>   
        </div>      
    </div>
    <div class="panel-body">
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'user-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
            		'id',
            		'name',
            		'email',
                    'last_login',
                    'is_locked',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view} {update} {lock} {unlock}',
                        'buttons'=>array(
                            'lock'=>array(
                            	'label'=>'<i class="icon-home"></i>',
                                'options'=>array('title'=>'禁闭', 'class'=>'actions'),
                                'visible'=>'$data->is_locked!="Y"',
                                'url'=>'url("user/lock", array("id"=>$data->id, "lock"=>1))',
                            ),
                            'unlock'=>array(
                                'label'=>'<i class="icon-repeat"></i>',
                                'options'=>array('title'=>'解禁', 'class'=>'actions'),
                                'visible'=>'$data->is_locked=="Y"',
                                'url'=>'url("user/lock", array("id"=>$data->id, "lock"=>0))',
                            ),
                        )
                    ),
            ),
        )); ?>
    </div>
</div>
<?php 
getCS()->registerScript('actions', '
	    $(document).on("click", "#user-grid a.actions", function(){
            $.post($(this).attr("href"), {}, function(){
                $("#user-grid").yiiGridView("update");
            }); 
	       return false;
        });
');
?>