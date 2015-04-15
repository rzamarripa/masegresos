<?php

/**
 * This is the model class for table "Edificio".
 *
 * The followings are the available columns in table 'Edificio':
 * @property string $id
 * @property string $descripcion
 * @property string $status
 * @property string $domicilio
 * @property string $cp
 * @property string $localidad
 * @property string $cu
 *
 * The followings are the available model relations:
 * @property Espacio[] $espacios
 */
class Edificio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Edificio the static model class
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
		return 'Edificio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, status, domicilio, cp, localidad, cu', 'required'),
			array('descripcion', 'length', 'max'=>40),
			array('status', 'length', 'max'=>1),
			array('domicilio', 'length', 'max'=>50),
			array('cp', 'length', 'max'=>5),
			array('localidad', 'length', 'max'=>9),
			array('cu', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, descripcion, status, domicilio, cp, localidad, cu', 'safe', 'on'=>'search'),
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
			'espacios' => array(self::HAS_MANY, 'Espacio', 'edificio_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descripcion' => 'Descripcion',
			'status' => 'Status',
			'domicilio' => 'Domicilio',
			'cp' => 'Cp',
			'localidad' => 'Localidad',
			'cu' => 'Cu',
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
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('domicilio',$this->domicilio,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('localidad',$this->localidad,true);
		$criteria->compare('cu',$this->cu,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}