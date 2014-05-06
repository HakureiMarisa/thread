<div class="panel panel-primary register-page">
	<div class="panel-heading">重置密码</div>
	<div class="panel-body">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'forget-form',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true
        )
    ));
    ?>
		<?php echo $form->passwordFieldRow($model,'password',array('maxlength'=>64)); ?>
	
        <?php echo $form->passwordFieldRow($model,'password1',array('maxlength'=>64)); ?>

		 <div class="form-actions">
        	<?php $this->widget('bootstrap.widgets.TbButton', array(
        			'buttonType'=>'submit',
        			'type'=>'primary',
        			'label'=>'提交',
    		)); ?>
        </div>

<?php $this->endWidget(); ?>
</div>
</div>
