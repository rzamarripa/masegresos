<?php

/**
 * This is the model class for table "DetalleOrdenCompra".
 *
 * The followings are the available columns in table 'DetalleOrdenCompra':
 * @property string $id
 * @property integer $cantidad
 * @property string $articulo_aid
 * @property double $precioUnitario
 * @property double $importe
 * @property string $ordenCompra_did
 *
 * The followings are the available model relations:
 * @property OrdenCompra $ordenCompra
 * @property Articulo $articulo
 */
class DetalleOrdenCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DetalleOrdenCompra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'DetalleOrdenCompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad', 'numerical', 'integerOnly'=>true),
			array('precioUnitario, importe', 'numerical'),
			array('articulo_aid, ordenCompra_did', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cantidad, articulo_aid, precioUnitario, importe, ordenCompra_did', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ordenCompra' => array(self::BELONGS_TO, 'OrdenCompra', 'ordenCompra_did'),
			'articulo' => array(self::BELONGS_TO, 'Articulo', 'articulo_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'articulo_aid' => 'Articulo',
			'precioUnitario' => 'Precio Unitario',
			'importe' => 'Importe',
			'ordenCompra_did' => 'Orden Compra',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('articulo_aid',$this->articulo_aid,true);
		$criteria->compare('precioUnitario',$this->precioUnitario);
		$criteria->compare('importe',$this->importe);
		$criteria->compare('ordenCompra_did',$this->ordenCompra_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}