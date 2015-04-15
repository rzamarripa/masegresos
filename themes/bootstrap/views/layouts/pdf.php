<!DOCTYPE html>
<html>
<head>
	<meta name="language" content="en" />
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
		<?php echo $content; ?>
</body>
</html>