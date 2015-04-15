<?php

/**
 * This is the model class for table "Seguimiento".
 *
 * The followings are the available columns in table 'Seguimiento':
 * @property string $id
 * @property string $numeroRequisicion
 * @property string $requisicion_aid
 * @property integer $cotizacion_aid
 * @property integer $ordenCompra_aid
 * @property string $fechaCreacion_f
 * @property string $fechaEnvio_f
 * @property string $fechaCotizacion_f
 * @property string $fechaOrdenCompra_f
 * @property string $fechaEntradaAlmacen_f
 * @property string $fechaSalidaAlmacen_f
 * @property string $fechaUltimaModificacion_f
 * @property string $estatus_did
 * @property string $usuarioCreacion
 * @property string $usuarioEnvio
 * @property string $usuarioCotizacion
 * @property string $usuarioOrdenCompra
 * @property string $usuarioEntradaAlmacen
 * @property string $usuarioSalidaAlmacen
 * @property string $usuarioUltimaModificacion
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property Requisicion $requisicion
 */
class Seguimiento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Seguimiento the static model class
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
		return 'Seguimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requisicion_aid, fechaUltimaModificacion_f', 'required'),
			array('cotizacion_aid, ordenCompra_aid', 'numerical', 'integerOnly'=>true),
			array('numeroRequisicion, usuarioCreacion, usuarioEnvio, usuarioCotizacion, usuarioOrdenCompra, usuarioEntradaAlmacen, usuarioSalidaAlmacen, usuarioUltimaModificacion', 'length', 'max'=>100),
			array('requisicion_aid, estatus_did', 'length', 'max'=>11),
			array('fechaCreacion_f, fechaEnvio_f, fechaCotizacion_f, fechaOrdenCompra_f, fechaEntradaAlmacen_f, fechaSalidaAlmacen_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, numeroRequisicion, requisicion_aid, cotizacion_aid, ordenCompra_aid, fechaCreacion_f, fechaEnvio_f, fechaCotizacion_f, fechaOrdenCompra_f, fechaEntradaAlmacen_f, fechaSalidaAlmacen_f, fechaUltimaModificacion_f, estatus_did, usuarioCreacion, usuarioEnvio, usuarioCotizacion, usuarioOrdenCompra, usuarioEntradaAlmacen, usuarioSalidaAlmacen, usuarioUltimaModificacion', 'safe', 'on'=>'search'),
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
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'requisicion' => array(self::BELONGS_TO, 'Requisicion', 'requisicion_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numeroRequisicion' => 'Numero Requisicion',
			'requisicion_aid' => 'Requisicion',
			'cotizacion_aid' => 'Cotizacion',
			'ordenCompra_aid' => 'Orden Compra',
			'fechaCreacion_f' => 'Fecha Creacion F',
			'fechaEnvio_f' => 'Fecha Envio F',
			'fechaCotizacion_f' => 'Fecha Cotizacion F',
			'fechaOrdenCompra_f' => 'Fecha Orden Compra F',
			'fechaEntradaAlmacen_f' => 'Fecha Entrada Almacen F',
			'fechaSalidaAlmacen_f' => 'Fecha Salida Almacen F',
			'fechaUltimaModificacion_f' => 'Fecha Ultima Modificacion F',
			'estatus_did' => 'Estatus',
			'usuarioCreacion' => 'Usuario Creacion',
			'usuarioEnvio' => 'Usuario Envio',
			'usuarioCotizacion' => 'Usuario Cotizacion',
			'usuarioOrdenCompra' => 'Usuario Orden Compra',
			'usuarioEntradaAlmacen' => 'Usuario Entrada Almacen',
			'usuarioSalidaAlmacen' => 'Usuario Salida Almacen',
			'usuarioUltimaModificacion' => 'Usuario Ultima Modificacion',
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
		$criteria->compare('numeroRequisicion',$this->numeroRequisicion,true);
		$criteria->compare('requisicion_aid',$this->requisicion_aid,true);
		$criteria->compare('cotizacion_aid',$this->cotizacion_aid);
		$criteria->compare('ordenCompra_aid',$this->ordenCompra_aid);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('fechaEnvio_f',$this->fechaEnvio_f,true);
		$criteria->compare('fechaCotizacion_f',$this->fechaCotizacion_f,true);
		$criteria->compare('fechaOrdenCompra_f',$this->fechaOrdenCompra_f,true);
		$criteria->compare('fechaEntradaAlmacen_f',$this->fechaEntradaAlmacen_f,true);
		$criteria->compare('fechaSalidaAlmacen_f',$this->fechaSalidaAlmacen_f,true);
		$criteria->compare('fechaUltimaModificacion_f',$this->fechaUltimaModificacion_f,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('usuarioCreacion',$this->usuarioCreacion,true);
		$criteria->compare('usuarioEnvio',$this->usuarioEnvio,true);
		$criteria->compare('usuarioCotizacion',$this->usuarioCotizacion,true);
		$criteria->compare('usuarioOrdenCompra',$this->usuarioOrdenCompra,true);
		$criteria->compare('usuarioEntradaAlmacen',$this->usuarioEntradaAlmacen,true);
		$criteria->compare('usuarioSalidaAlmacen',$this->usuarioSalidaAlmacen,true);
		$criteria->compare('usuarioUltimaModificacion',$this->usuarioUltimaModificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}