<div class="panel panel-primary register-page">
	<div class="panel-heading">找回用户名密码</div>
	<div class="panel-body">
	<?php if(getApp()->user->hasFlash('forget')):?>
	<?php echo getApp()->user->getFlash('forget')?>
	<?php else:?>	
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
		<?php echo $form->textFieldRow($model, 'email', array(), array('label'=>'请填写您的注册邮箱')); ?>

		 <div class="form-actions">
        	<?php $this->widget('bootstrap.widgets.TbButton', array(
        			'buttonType'=>'submit',
        			'type'=>'primary',
        			'label'=>'提交',
    		)); ?>
        </div>
    <?php $this->endWidget(); ?>
    <?php endif;?>
</div>
</div>
