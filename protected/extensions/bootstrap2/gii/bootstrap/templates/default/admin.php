<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
/*
$terminacion = substr($this->class2name('esquz'), -1);
$consonantes = array('a','e','i','o','u','z');
$iua = array('i','o','u');
$pluralizacion = "";
echo 'La terminación es: ' . $terminacion;
if(strcmp ($terminacion ,'é' )!=0)
	echo 's';
else if(in_array($terminacion, $iua ))
	echo 'es';
else if(in_array($terminacion, $consonantes ))
	echo 'es';
else if(strcmp ($terminacion ,'z' )!=0)
{
	echo substr_replace('esquz','es',-1,-1); //eggxs 
	echo 'ultimo';
}
	
exit;
*/
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Administrar',
);\n";
?>

$this->menu=array(
	array('label'=>'Listar <?php echo $this->modelClass; ?>','url'=>array('index')),
	array('label'=>'Crear <?php echo $this->modelClass; ?>','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>

<p>
Opcionalmente puede usar operadores de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al principio de cada criterio de búsqueda..
</p>

<?php echo "<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button btn')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	$partes = explode('_',$column->name);
	$finalCampo=$partes[count($partes)-1];
	$relacion=$partes[0];
	$modeloColumna=ucwords($partes[0]);
	
	if($finalCampo=='did' || $finalCampo=='aid')
		echo "\t\tarray('name'=>'{$column->name}',
		        'value'=>'\$data->{$relacion}->nombre',
			    'filter'=>CHtml::listData({$modeloColumna}::model()->findAll(), 'id', 'nombre'),),\n";
	else
		echo "\t\t'".$column->name."',\n";
}

if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
