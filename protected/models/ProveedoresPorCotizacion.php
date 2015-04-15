<?php

/**
 * This is the model class for table "ProveedoresPorCotizacion".
 *
 * The followings are the available columns in table 'ProveedoresPorCotizacion':
 * @property string $id
 * @property string $cotizacion_aid
 * @property string $proveedor_aid
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property Cotizacion $cotizacion
 * @property Proveedor $proveedor
 */
class ProveedoresPorCotizacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProveedoresPorCotizacion the static model class
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
		return 'ProveedoresPorCotizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cotizacion_aid, proveedor_aid', 'required'),
			array('cotizacion_aid, proveedor_aid, estatus_did', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cotizacion_aid, proveedor_aid, estatus_did', 'safe', 'on'=>'search'),
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
			'cotizacion' => array(self::BELONGS_TO, 'Cotizacion', 'cotizacion_aid'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cotizacion_aid' => 'Cotizacion',
			'proveedor_aid' => 'Proveedor',
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
		$criteria->compare('cotizacion_aid',$this->cotizacion_aid,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}