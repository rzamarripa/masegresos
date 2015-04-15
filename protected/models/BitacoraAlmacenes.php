<?php

/**
 * This is the model class for table "BitacoraAlmacenes".
 *
 * The followings are the available columns in table 'BitacoraAlmacenes':
 * @property string $id
 * @property string $usuario_did
 * @property string $ordenCompra_did
 * @property integer $recibioUO
 * @property string $nombreRecibioUO
 * @property string $fechaCreacion_f
 * @property string $estatus_did
 * @property string $nombreRecibioAlmacen
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property OrdenCompra $ordenCompra
 * @property Usuario $usuario
 */
class BitacoraAlmacenes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BitacoraAlmacenes the static model class
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
		return 'BitacoraAlmacenes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_did, ordenCompra_did', 'required'),
			array('recibioUO', 'numerical', 'integerOnly'=>true),
			array('usuario_did, ordenCompra_did, estatus_did', 'length', 'max'=>11),
			array('nombreRecibioUO, nombreRecibioAlmacen', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, usuario_did, ordenCompra_did, recibioUO, nombreRecibioUO, nombreRecibioAlmacen, fechaCreacion_f, estatus_did', 'safe', 'on'=>'search'),
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
			'ordenCompra' => array(self::BELONGS_TO, 'OrdenCompra', 'ordenCompra_did'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_did' => 'Usuario',
			'ordenCompra_did' => 'Orden Compra',
			'recibioUO' => 'Recibio Uo',
			'nombreRecibioAlmacen' => 'Nombre Recibió Almacén',
			'nombreRecibioUO' => 'Nombre Recibió',
			'fechaCreacion_f' => 'Fecha Creación',
			'estatus_did' => 'Estatus',
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
		$criteria->compare('usuario_did',$this->usuario_did,true);
		$criteria->compare('ordenCompra_did',$this->ordenCompra_did,true);
		$criteria->compare('recibioUO',$this->recibioUO);
		$criteria->compare('nombreRecibioUO',$this->nombreRecibioUO,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('nombreRecibioAlmacen',$this->nombreRecibioAlmacen,true);
		$criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}