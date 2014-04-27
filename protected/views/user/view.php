<div class="panel panel-default">
    <div class="panel-heading"><?php echo $model->name?></div>
    <div class="panel-body">
        <?php $this->widget('bootstrap.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
            		'email',
            ),
        )); ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">最近发布话题</div>
    <div class="panel-body">
        <?php 
        $c = new CDbCriteria();
        $c->compare('t.create_by', $model->id);
        $c->order = 't.create_on DESC';
        $c->with = array('creater');
        $c->together = true;
    	$this->widget('bootstrap.widgets.TbListView', array(
    			'dataProvider' => new CActiveDataProvider('Topic', array('criteria'=>$c, 'pagination'=>array(
                    'pageSize'=>5,
                ),)),
    			'itemView' => '_last_topics',
    			'id'=>'topic-list',
    			'template'=>'{items}',
    			'htmlOptions'=>array('class'=>false),
    	))?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">最近参与话题</div>
    <div class="panel-body">
        <?php 
        $c = new CDbCriteria();
        $c->compare('t.create_by', $model->id);
        $c->with = array('topic', 'content');
        $c->together = true;
        $c->compare('topic.create_by', "<>".$model->id);
        $c->order = 't.create_on DESC';
    	$this->widget('bootstrap.widgets.TbListView', array(
    			'dataProvider' => new CActiveDataProvider('Thread', array('criteria'=>$c, 'pagination'=>array(
                    'pageSize'=>5,
                ),)),
    			'itemView' => '_last_reply_topics',
    			'id'=>'topic-list',
    			'template'=>'{items}',
    			'htmlOptions'=>array('class'=>false),
    	))?>
    </div>
</div>