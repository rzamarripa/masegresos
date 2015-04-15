<?php

/**
 * This is the model class for table "requisiciontemp".
 *
 * The followings are the available columns in table 'requisiciontemp':
 * @property string $id
 * @property string $numero
 * @property string $fechaCreacion_f
 * @property string $usuario_did
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property Estatus $estatusD
 * @property Usuario $usuarioD
 */
class Requisiciontemp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Requisiciontemp the static model class
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
		return 'requisiciontemp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero, estatus_did, unidadOrganizacional_did', 'required'),
			array('numero', 'length', 'max'=>10),
			array('usuario_did, estatus_did, unidadOrganizacional_did', 'length', 'max'=>11),
			array('numero', 'unique'),
			array('fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, numero, unidadOrganizacional_did, fechaCreacion_f, usuario_did, estatus_did', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numero' => 'Número',
			'unidadOrganizacional_did'=>'Unidad Organizacional',
			'fechaCreacion_f' => 'Fecha Creación',
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
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('usuario_did',$this->usuario_did,true);
		$criteria->compare('unidadOrganizacional_did',$this->unidadOrganizacional_did,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
}