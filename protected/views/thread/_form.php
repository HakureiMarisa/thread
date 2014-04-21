<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'thread-form', 
		'enableClientValidation'=>true,
		'action'=>array('thread/add')
))?>
<?php
 $model = new Thread();
 $model->topic_id = $topic->id;
 ?>
<?php echo $form->hiddenField($model, 'topic_id')?>
<?php $content = new ThreadContent();?>
<?php echo $form->textAreaRow($content, 'content', array('class'=>'editor', 'rows'=>5), array(
		'errorOptions'=>array(
				'class'=>'help-block',
		),
        'label'=>false,
))?>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'发表')); ?>
    </div>
<?php $this->endWidget()?>
</form>
<?php $this->renderPartial('//topic/_script', array(
    'form'=>'thread-form', 
    'list'=>'thread-list'    
));?>