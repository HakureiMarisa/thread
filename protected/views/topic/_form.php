<?php $this->renderPartial('//topic/_script', array(
    'form'=>'topic-form', 
    'list'=>'topic-list'    
));?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'topic-form', 
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'action'=>array('topic/add'),
        'clientOptions'=>array(
	       'validateOnSubmit'=>true,
            /*'beforeValidate'=>"js:function(){
                if($('#ThreadContent_content').val()=='<p><br></p>'){    
                    $('#ThreadContent_content').val('');
                }
                return true;
            }",*/
            'afterValidate'=>'js:function(form, data, hasError){$.formAjaxSubmit(form, data, hasError, "topic-list")}'
        )
))?>
<?php $model = new Topic()?>
<?php echo $form->textFieldRow($model, 'title', array(), array(
		'errorOptions'=>array(
				'class'=>'help-block',
		)
))?>

<?php $content = new ThreadContent();?>
<?php echo $form->textAreaRow($content, 'content', array('class'=>'editor', 'rows'=>10), array(
		'errorOptions'=>array(
				'class'=>'help-block',
		)
))?>
<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
    </div>
<?php $this->endWidget()?>