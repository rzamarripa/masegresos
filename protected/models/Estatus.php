<?php

/**
 * This is the model class for table "Estatus".
 *
 * The followings are the available columns in table 'Estatus':
 * @property string $id
 * @property string $nombre
 * @property string $requisicion
 * @property string $cotizacion
 * @property string $ordenCompra
 * @property string $ordenCompraAlmacen
 * @property string $contrarecibo
 * @property string $fechaCreacion_f
 *
 * The followings are the available model relations:
 * @property Almacen[] $almacens
 * @property BitacoraAlmacenes[] $bitacoraAlmacenes
 * @property Ciudad[] $ciudads
 * @property Cotizacion[] $cotizacions
 * @property DetalleContrarecibo[] $detalleContrarecibos
 * @property Estado[] $estados
 * @property OrdenCompra[] $ordenCompras
 * @property OrdenCompra[] $ordenCompras1
 * @property Proveedor[] $proveedors
 * @property ProveedoresPorRequisicion[] $proveedoresPorRequisicions
 * @property Requisicion[] $requisicions
 * @property TipoGrupo[] $tipoGrupos
 * @property TipoUsuario[] $tipoUsuarios
 * @property Unidad[] $unidads
 * @property Usuario[] $usuarios
 */
class Estatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Estatus the static model class
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
		return 'Estatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, requisicion, cotizacion, ordenCompra, ordenCompraAlmacen, contrarecibo', 'length', 'max'=>100),
			array('fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, requisicion, cotizacion, ordenCompra, ordenCompraAlmacen, contrarecibo, fechaCreacion_f', 'safe', 'on'=>'search'),
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
			'almacen' => array(self::HAS_MANY, 'Almacen', 'estatus_did'),
			'bitacoraAlmacenes' => array(self::HAS_MANY, 'BitacoraAlmacenes', 'estatus_did'),
			'ciudad' => array(self::HAS_MANY, 'Ciudad', 'estatus_did'),
			'cotizacion' => array(self::HAS_MANY, 'Cotizacion', 'estatus_did'),
			'detalleContrarecibo' => array(self::HAS_MANY, 'DetalleContrarecibo', 'estatus_did'),
			'estados' => array(self::HAS_MANY, 'Estado', 'estatus_did'),
			'ordenCompra' => array(self::HAS_MANY, 'OrdenCompra', 'estatus_did'),
			'ordenCompras1' => array(self::HAS_MANY, 'OrdenCompra', 'estatusAlmacen_did'),
			'proveedor' => array(self::HAS_MANY, 'Proveedor', 'estatus_did'),
			'proveedoresPorRequisicion' => array(self::HAS_MANY, 'ProveedoresPorRequisicion', 'estatus_did'),
			'requisicion' => array(self::HAS_MANY, 'Requisicion', 'estatus_did'),
			'tipoGrupo' => array(self::HAS_MANY, 'TipoGrupo', 'estatus_did'),
			'tipoUsuario' => array(self::HAS_MANY, 'TipoUsuario', 'estatus_did'),
			'unidad' => array(self::HAS_MANY, 'Unidad', 'estatus_did'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'estatus_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'requisicion' => 'Requisicion',
			'cotizacion' => 'Cotizacion',
			'ordenCompra' => 'Orden Compra',
			'ordenCompraAlmacen' => 'Orden Compra Almacen',
			'contrarecibo' => 'Contrarecibo',
			'fechaCreacion_f' => 'Fecha Creacion F',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('requisicion',$this->requisicion,true);
		$criteria->compare('cotizacion',$this->cotizacion,true);
		$criteria->compare('ordenCompra',$this->ordenCompra,true);
		$criteria->compare('ordenCompraAlmacen',$this->ordenCompraAlmacen,true);
		$criteria->compare('contrarecibo',$this->contrarecibo,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}