<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<div class="panel-title pull-left">话题</div>
		<a class="pull-right" href="#form">新话题</a>
	</div>
	<div class="panel-body">
	<?php
	$this->widget('bootstrap.widgets.TbListView', array(
			'dataProvider' => $model->search(),
			'itemView' => '//topic/_topic',
			'id'=>'topic-list',
			'template'=>'{items} {pager}',
			'htmlOptions'=>array('class'=>false),
	))?>
	</div>
</div>
<div class="panel panel-default" id="form">
	<div class="panel-body">
        <?php if (!getApp()->user->isGuest):?>
        <?php $this->renderPartial("//topic/_form")?>
        <?php else:?>
        <?php echo CHtml::link('登陆发表', array('site/login'), array('class'=>'btn btn-default'))?>
        <?php endif;?>		
	</div>
</div>
