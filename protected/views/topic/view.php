<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo $topic->title?>
	</div>
</div>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
		'dataProvider' => new CArrayDataProvider($topic->threads),
		'itemView' => '//topic/_view',
		'id'=>'thread-list',
		'template'=>'{items} {pager}',
		'htmlOptions'=>array('class'=>false),
))?>

<div class="panel panel-default">
	<div class="panel-body">
	<?php if (!getApp()->user->isGuest):?>
    <?php $this->renderPartial('//thread/_form', array('topic'=>$topic));?>
    <?php else:?>
    <?php getApp()->user->returnUrl = array('/topic/view', 'id'=>$topic->id)?>
    <?php echo CHtml::link('登陆发表', array('site/login'), array('class'=>'btn btn-default'))?>
    <?php endif;?>
    </div>
</div>
