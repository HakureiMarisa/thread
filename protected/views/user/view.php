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
        $c->compare('create_by', $model->id);
        $c->order = 'create_on DESC';
    	$this->widget('bootstrap.widgets.TbListView', array(
    			'dataProvider' => new CActiveDataProvider('Topic', array('criteria'=>$c, 'pagination'=>array(
                    'pageSize'=>5,
                ),)),
    			'itemView' => '//topic/_topic',
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
        $c->compare('t.create_by', "<>".$model->id);
        $c->with = array('threads');
        $c->together = true;
        $c->compare('threads.create_by', $model->id);
        $c->order = 'threads.create_on DESC';
    	$this->widget('bootstrap.widgets.TbListView', array(
    			'dataProvider' => new CActiveDataProvider('Topic', array('criteria'=>$c, 'pagination'=>array(
                    'pageSize'=>5,
                ),)),
    			'itemView' => '//topic/_topic',
    			'id'=>'topic-list',
    			'template'=>'{items}',
    			'htmlOptions'=>array('class'=>false),
    	))?>
    </div>
</div>