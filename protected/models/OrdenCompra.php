<?php

/**
 * This is the model class for table "OrdenCompra".
 *
 * The followings are the available columns in table 'OrdenCompra':
 * @property string $id
 * @property string $numeroOrdenCompra
 * @property string $fecha_f
 * @property string $proveedor_aid
 * @property string $unidadOrganizacional_aid
 * @property string $requisicion_did
 * @property double $subtotal
 * @property double $iva
 * @property double $total
 * @property string $estatus_did
 * @property string $estatusAlmacen_did
 * @property string $fechaRecepcion_f
 * @property string $fechaCancelacionRecepcion_f
 *
 * The followings are the available model relations:
 * @property BitacoraAlmacenes[] $bitacoraAlmacenes
 * @property DetalleContrarecibo[] $detalleContrarecibos
 * @property DetalleOrdenCompra[] $detalleOrdenCompras
 * @property Estatus $estatus
 * @property Estatus $estatusAlmacen
 * @property Proveedor $proveedor
 * @property Requisicion $requisicion
 * @property UnidadOrganizacional $unidadOrganizacional
 */
class OrdenCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OrdenCompra the static model class
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
		return 'OrdenCompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subtotal, iva, total, tipoEntrega', 'numerical'),
			array('numeroOrdenCompra, comentarioAlmacenista', 'length', 'max'=>100),
			array('proveedor_aid, requisicion_did, proyecto_aid, almacen_aid', 'length', 'max'=>11),
			array('unidadOrganizacional_aid, estatus_did, estatusAlmacen_did', 'length', 'max'=>10),
			array('fecha_f, fechaRecepcion_f, fechaCancelacionRecepcion_f, fechaSalida_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, numeroOrdenCompra, tipoEntrega, fecha_f, proveedor_aid, unidadOrganizacional_aid, requisicion_did, subtotal, iva, total, estatus_did, estatusAlmacen_did, fechaRecepcion_f, fechaCancelacionRecepcion_f', 'safe', 'on'=>'search'),
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
			'bitacoraAlmacenes' => array(self::HAS_MANY, 'BitacoraAlmacenes', 'ordenCompra_did'),
			'detalleContrarecibos' => array(self::HAS_MANY, 'DetalleContrarecibo', 'ordenCompra_did'),
			'detalleOrdenCompras' => array(self::HAS_MANY, 'DetalleOrdenCompra', 'ordenCompra_did'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'estatusAlmacen' => array(self::BELONGS_TO, 'Estatus', 'estatusAlmacen_did'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_aid'),
			'requisicion' => array(self::BELONGS_TO, 'Requisicion', 'requisicion_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_aid'),
			'proyecto' => array(self::BELONGS_TO, 'Proyecto', 'proyecto_aid'),
			'cotizacion' => array(self::BELONGS_TO, 'Cotizacion', 'cotizacion_did'),
			'almacen' => array(self::BELONGS_TO, 'Almacen', 'almacen_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numeroOrdenCompra' => 'Orden Compra',
			'fecha_f' => 'Fecha',
			'proveedor_aid' => 'Proveedor',
			'unidadOrganizacional_aid' => 'Unidad Organizacional',
			'requisicion_did' => 'Requisición',
			'subtotal' => 'Subtotal',
			'iva' => 'Iva',
			'total' => 'Total',
			'estatus_did' => 'Estatus',
			'estatusAlmacen_did' => 'Estatus Almacén',
			'fechaRecepcion_f' => 'Fecha Recepción',
			'fechaCancelacionRecepcion_f' => 'Fecha Cancelación',
			'proyecto_aid' => 'Proyecto',
			'cotizacion_did' => 'Fecha Entrega',
			'tipoEntrega' => 'Tipo de Entrega',
			'almacen_aid' => 'Almacén',
			'fechaSalida_f' => "Fecha de Salida",
			'comentarioAlmacenista' => "Comentario Almacenista"
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchDoctos($proveedorId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('numeroOrdenCompra',$this->numeroOrdenCompra,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('proveedor_aid',$proveedorId,false);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,false);
		$criteria->compare('requisicion_did',$this->requisicion_did,false);
		$criteria->compare('proyecto_aid',$this->proyecto_aid,false);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('estatus_did',$this->estatus_did,false);
		$criteria->compare('estatusAlmacen_did',$this->estatusAlmacen_did,false);
		$criteria->compare('fechaRecepcion_f',$this->fechaRecepcion_f,true);
		$criteria->compare('fechaCancelacionRecepcion_f',$this->fechaCancelacionRecepcion_f,true);
		$criteria->compare('tipoEntrega',$this->tipoEntrega,true);
		$criteria->compare('almacen_aid',$this->almacen_aid,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('numeroOrdenCompra',$this->numeroOrdenCompra,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,false);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,false);
		$criteria->compare('requisicion_did',$this->requisicion_did,false);
		$criteria->compare('proyecto_aid',$this->proyecto_aid,false);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('estatus_did',$this->estatus_did,false);
		$criteria->compare('estatusAlmacen_did',$this->estatusAlmacen_did,false);
		$criteria->compare('fechaRecepcion_f',$this->fechaRecepcion_f,true);
		$criteria->compare('fechaCancelacionRecepcion_f',$this->fechaCancelacionRecepcion_f,true);
		$criteria->compare('tipoEntrega',$this->tipoEntrega,true);
		$criteria->compare('almacen_aid',$this->almacen_aid,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchalmacenista($almacenId)
	{		
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('numeroOrdenCompra',$this->numeroOrdenCompra,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,false);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,true);
		$criteria->compare('requisicion_did',$this->requisicion_did,false);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('estatusAlmacen_did',$this->estatusAlmacen_did,true);
		$criteria->compare('tipoEntrega',$this->tipoEntrega,true);		
		$criteria->compare('almacen_aid',$almacenId,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function to_array() {
		return array(
			'id' => $this->id,
			'numeroOrdenCompra' => $this->numeroOrdenCompra,
			'fecha' => $this->fecha_f,
			'subtotal' => $this->subtotal,
			'iva' => $this->iva,
			'total' => $this->total
		);
	}
}