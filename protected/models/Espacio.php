<?php

/**
 * This is the model class for table "Espacio".
 *
 * The followings are the available columns in table 'Espacio':
 * @property string $id
 * @property string $funcion_did
 * @property string $edificio_did
 * @property string $uO_did
 *
 * The followings are the available model relations:
 * @property Edificio $edificio
 * @property Funcion $funcion
 * @property UnidadOrganizacional $uO
 * @property Inventario[] $inventarios
 */
class Espacio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Espacio the static model class
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
		return 'Espacio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('funcion_did, uO_did', 'required'),
			array('funcion_did, edificio_did, uO_did', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, funcion_did, edificio_did, uO_did', 'safe', 'on'=>'search'),
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
			'edificio' => array(self::BELONGS_TO, 'Edificio', 'edificio_did'),
			'funcion' => array(self::BELONGS_TO, 'Funcion', 'funcion_did'),
			'uO' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'uO_did'),
			'inventarios' => array(self::HAS_MANY, 'Inventario', 'espacio_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'funcion_did' => 'Funcion',
			'edificio_did' => 'Edificio',
			'uO_did' => 'U O',
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
		$criteria->compare('funcion_did',$this->funcion_did,true);
		$criteria->compare('edificio_did',$this->edificio_did,true);
		$criteria->compare('uO_did',$this->uO_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}