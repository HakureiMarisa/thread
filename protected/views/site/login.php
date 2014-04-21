<div class="panel panel-primary register-page">
	<div class="panel-heading">登陆</div>
	<div class="panel-body">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'login-form',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true
        )
    ));
    ?>
		<?php echo $form->textFieldRow($model,'username'); ?>

		<?php echo $form->passwordFieldRow($model,'password'); ?>

	   <div class="rememberMe">
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
	   </div>

		 <div class="form-actions">
        	<?php $this->widget('bootstrap.widgets.TbButton', array(
        			'buttonType'=>'submit',
        			'type'=>'primary',
        			'label'=>'登陆',
        		)); ?>
        </div>

<?php $this->endWidget(); ?>
</div>
</div>
