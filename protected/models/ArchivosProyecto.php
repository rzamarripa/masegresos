<?php

/**
 * This is the model class for table "ArchivosProyecto".
 *
 * The followings are the available columns in table 'ArchivosProyecto':
 * @property string $id
 * @property string $proyecto_aid
 * @property string $nombre
 * @property string $ruta
 * @property string $fechaCreacion_f
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property Proyecto $proyecto
 */
class ArchivosProyecto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArchivosProyecto the static model class
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
		return 'ArchivosProyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('proyecto_aid', 'length', 'max'=>10),
			array('nombre, ruta', 'length', 'max'=>100),
			array('estatus_did', 'length', 'max'=>11),
			array('fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, proyecto_aid, nombre, ruta, fechaCreacion_f, estatus_did', 'safe', 'on'=>'search'),
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
			'proyecto' => array(self::BELONGS_TO, 'Proyecto', 'proyecto_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'proyecto_aid' => 'Proyecto',
			'nombre' => 'Nombre',
			'ruta' => 'Ruta',
			'fechaCreacion_f' => 'Fecha Creacion F',
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
		$criteria->compare('proyecto_aid',$this->proyecto_aid,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}