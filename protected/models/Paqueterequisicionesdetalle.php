<?php

/**
 * This is the model class for table "paqueterequisicionesdetalle".
 *
 * The followings are the available columns in table 'paqueterequisicionesdetalle':
 * @property string $id
 * @property string $paqueteRequisicion_did
 * @property string $requisicion_did
 * @property string $fechaCreacion_f
 * @property string $usuario_did
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property Paqueterequisiciones $paqueteRequisicion
 * @property Requisicion $requisicion
 * @property Usuario $usuario
 */
class PaqueteRequisicionesDetalle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Paqueterequisicionesdetalle the static model class
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
		return 'paqueterequisicionesdetalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paqueteRequisicion_did, requisicion_did, usuario_did, estatus_did', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, paqueteRequisicion_did, requisicion_did, fechaCreacion_f, usuario_did, estatus_did', 'safe', 'on'=>'search'),
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
			'paqueteRequisicion' => array(self::BELONGS_TO, 'Paqueterequisiciones', 'paqueteRequisicion_did'),
			'requisicion' => array(self::BELONGS_TO, 'Requisicion', 'requisicion_did'),
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
			'paqueteRequisicion_did' => 'Paquete Requisición',
			'requisicion_did' => 'Requisición',
			'fechaCreacion_f' => 'Fecha Creacion F',
			'usuario_did' => 'Usuario',
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
		$criteria->compare('paqueteRequisicion_did',$this->paqueteRequisicion_did,true);
		$criteria->compare('requisicion_did',$this->requisicion_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('usuario_did',$this->usuario_did,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}