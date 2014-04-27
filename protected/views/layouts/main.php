<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- <script type="text/javascript" src="<?php echo getBaseUrl().'/scripts/jquery-1.11.0.min.js'?>"></script> -->
	
 	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css" />
</head>

<body>
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
		'type'=>'inverse',
		'items'=>array(
		    array(
		        'class' => 'bootstrap.widgets.TbMenu',
		        'items' => array(
		            array('label'=>'用户管理', 'url'=>array('/user/index'), 'visible'=>!Yii::app()->user->isGuest),

		        ),
		    ),
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items' => array(
					//array('label'=>'Home', 'url'=>array('/site/index')),
					//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					//array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'登陆', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'注册', 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'注销 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			)			
		),
)); ?>
<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<?php echo $content; ?>

</div><!-- page -->
<div id="gotop">回到顶部</div>
<hr>
<div id="footer">
	<div class="container">
	Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
	All Rights Reserved.<br/>
	<?php echo Yii::powered(); ?>
	</div>
</div><!-- footer -->

</body>
</html>
<?php getCS()->registerScriptFile(getBaseUrl().'/scripts/site.js');?>