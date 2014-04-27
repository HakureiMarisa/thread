<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
       'validateOnSubmit'=>true,
    )
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>64)); ?>
	
	<?php echo $form->passwordFieldRow($model,'password1',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
