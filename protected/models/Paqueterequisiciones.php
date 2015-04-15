<?php

/**
 * This is the model class for table "paqueterequisiciones".
 *
 * The followings are the available columns in table 'paqueterequisiciones':
 * @property string $id
 * @property string $nombre
 * @property string $fechaCreacion_f
 * @property string $usuario_did
 * @property string $estatus_did
 *
 * The followings are the available model relations:
 * @property Estatus $estatus
 * @property Usuario $usuario
 * @property Paqueterequisicionesdetalle[] $paqueterequisicionesdetalles
 */
class PaqueteRequisiciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Paqueterequisiciones the static model class
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
		return 'paqueterequisiciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'unique'),
			array('nombre, enviadoa', 'required'),
			array('nombre', 'length', 'max'=>100),
			array('usuario_did, estatus_did', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, fechaCreacion_f, usuario_did, estatus_did', 'safe', 'on'=>'search'),
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
			'paqueterequisicionesdetalles' => array(self::HAS_MANY, 'Paqueterequisicionesdetalle', 'paqueteRequisicion_did'),
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
			'fechaCreacion_f' => 'Fecha Creación',
			'usuario_did' => 'Usuario',
			'estatus_did' => 'Estatus',
			'enviadoa' => 'Enviar a',
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
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('usuario_did',$this->usuario_did,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		if($usuarioActual->tipoUsuario->nombre == "Almacen"){
			$criteria->condition ="estatus_did != 1 && enviadoa = 0";
		}else if($usuarioActual->tipoUsuario->nombre == "Pasivo"){
			$criteria->condition ="estatus_did != 1 && enviadoa = 1";
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}