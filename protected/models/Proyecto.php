<?php

/**
 * This is the model class for table "Proyecto".
 *
 * The followings are the available columns in table 'Proyecto':
 * @property string $id
 * @property string $nombre
 * @property string $investigador
 * @property string $fechaInicio_f
 * @property string $fechaFin_f
 * @property string $unidadOrganizacional_aid
 * @property string $fechaCreacion_f
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property OrdenCompra[] $ordenCompras
 * @property Estatus $estatus
 * @property UnidadOrganizacional $unidadOrganizacional
 */
class Proyecto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Proyecto the static model class
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
		return 'Proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, investigador, fechaInicio_f, fechaFin_f, unidadOrganizacional_aid, estatus_did','required'),
			array('nombre', 'length', 'max'=>200),
			array('investigador', 'length', 'max'=>100),
			array('unidadOrganizacional_aid', 'length', 'max'=>10),
			array('estatus_did', 'length', 'max'=>11),
			array('fechaInicio_f, fechaFin_f, fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, investigador, fechaInicio_f, fechaFin_f, unidadOrganizacional_aid, fechaCreacion_f, estatus_did', 'safe', 'on'=>'search'),
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
			'ordenCompras' => array(self::HAS_MANY, 'OrdenCompra', 'proyecto_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_aid'),
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
			'investigador' => 'Investigador',
			'fechaInicio_f' => 'Fecha Inicio',
			'fechaFin_f' => 'Fecha Fin',
			'unidadOrganizacional_aid' => 'Unidad Organizacional',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('investigador',$this->investigador,true);
		$criteria->compare('fechaInicio_f',$this->fechaInicio_f,true);
		$criteria->compare('fechaFin_f',$this->fechaFin_f,true);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}