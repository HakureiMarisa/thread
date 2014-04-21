<div class="timeline-discussant-wrapper clearfix">
	<?php echo CHtml::link($data->discussant->name, array('user/view', 'id'=>$data->discussant->id), array('class'=>'discussant'))?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo $data->create_on?>
		</div>
		<div class="panel-body">
			<?php echo $data->content->content?>
		</div>
	</div>
</div>
