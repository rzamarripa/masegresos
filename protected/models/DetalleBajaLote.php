<?php

/**
 * This is the model class for table "detalleBajaLote".
 *
 * The followings are the available columns in table 'detalleBajaLote':
 * @property string $id
 * @property string $detalleInventario_did
 * @property string $cantidadBaja
 * @property string $bajaResguardo
 * @property string $motivo_did
 */
class DetalleBajaLote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DetalleBajaLote the static model class
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
		return 'detalleBajaLote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('detalleInventario_did, cantidadBaja, bajaResguardo, motivo_did', 'required'),
			array('detalleInventario_did, cantidadBaja, bajaResguardo, motivo_did', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, detalleInventario_did, cantidadBaja, bajaResguardo, fechaBaja_f, motivo_did, autorizo_did', 'safe', 'on'=>'search'),
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
			'detalleinventario' => array(self::BELONGS_TO, 'detalleInventario', 'detalleInventario_did'),
			'motivoBaja' => array(self::BELONGS_TO, 'MotivoBaja', 'motivo_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detalleInventario_did' => 'Detalle Inventario',
			'cantidadBaja' => 'Cantidad Baja',
			'bajaResguardo' => 'Baja Resguardo',
			'motivo_did' => 'Motivo',
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
		$criteria->compare('detalleInventario_did',$this->detalleInventario_did,true);
		$criteria->compare('cantidadBaja',$this->cantidadBaja,true);
		$criteria->compare('bajaResguardo',$this->bajaResguardo,true);
		$criteria->compare('motivo_did',$this->motivo_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}