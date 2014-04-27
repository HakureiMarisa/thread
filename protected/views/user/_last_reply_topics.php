<div class="cell">
在 <?php echo CHtml::link($data->topic->title, url('topic/view', array('id'=>$data->id)))?> 说到：
<span title="创建时间" class="pull-right">
    <i class="icon-time"></i><span class="last_active_time"><?php echo $data->create_on?></span>
</span>
<?php echo $data->content->content?> 
</div>