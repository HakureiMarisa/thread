<div class="cell">
	<a class="pull-left" href="<?php echo url('user/view', array('id'=>$data->creater->id))?>" title="创建者">
		 <i class="icon-user"></i><?php echo $data->creater->name?>
	</a> 
	<span class="reply_count pull-left"> 
		<span class="count_of_replies" title="回复数"> <?php echo $data->thread_connts?> </span> 
		<span class="count_seperator">/</span>
		<span class="count_of_visits" title="点击数"> <?php echo $data->visits?> </span>
	</span>
    <span class="last_time pull-right">
        <?php if (isset($data->last_thread) && $data->last_thread):?>
        <a class="pull-left" href="<?php echo url('user/view', array('id'=>$data->last_thread->discussant->id))?>" title="最近回复者">
            <i class="icon-user"></i><span class="last_active_user"><?php echo $data->last_thread->discussant->name?></span>
        </a>
        <span title="回复时间">
            <i class="icon-time"></i><span class="last_active_time"><?php echo $data->last_thread->create_on?></span>
        </span>
        <?php endif;?>
    </span>
	<?php echo CHtml::link($data->title, url('topic/view', array('id'=>$data->id)))?>
</div>


