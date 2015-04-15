<?php
echo "<?php\n";
$label=$this->class2name($this->modelClass);
echo "\$this->pageCaption='Adminsitrar ';
\$this->pageTitle=Yii::app()->name . ' - ' . \$this->pageCaption;
\$this->pageDescription='".strtolower($label)."';
\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Adminsitrar',
);\n";
?>

$this->menu=array(
	array('label'=>'Listar <?php echo $this->modelClass; ?>','url'=>array('index')),
	array('label'=>'Crear <?php echo $this->modelClass; ?>','url'=>array('create')),
);
?>

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
	if($finalCampo != 'f'){
		if($finalCampo=='did' || $finalCampo=='aid')
			echo "\t\tarray('name'=>'{$column->name}',
			        'value'=>'\$data->{$relacion}->nombre',
				    'filter'=>CHtml::listData({$modeloColumna}::model()->findAll(), 'id', 'nombre'),),\n";
		else
			echo "\t\t'".$column->name."',\n";
	}
}

if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
