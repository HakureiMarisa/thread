<div class="cell">
	<a class="pull-left" href="#">
		<?php echo $data->creater->name?>
	</a> 
	<span class="reply_count pull-left"> 
		<span class="count_of_replies" title="回复数"> <?php echo $data->thread_connts?> </span> 
		<span class="count_seperator">/</span>
		<span class="count_of_visits" title="点击数"> <?php echo $data->visits?> </span>
	</span>
    <span class="last_time pull-right" href="/topic/53473dde502e5602740078bc#5350e3e81969a7b22a6f8cf4">
      <img class="user_small_avatar" src="http://cnodegravatar.u.qiniudn.com/avatar/09a2869724dab220fe764076b5a40f40?s=48">
      <span class="last_active_time"><?php echo $data->create_on?></span>
    </span>
	<?php echo CHtml::link($data->title, url('topic/view', array('id'=>$data->id)))?>
</div>


