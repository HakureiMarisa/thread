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
    <?php $this->renderPartial('//thread/_form', array('topic'=>$topic));?>
    </div>
</div>