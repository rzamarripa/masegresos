<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id
 * @property string $usuario
 * @property string $contrasena
 * @property string $tipoUsuario_did
 * @property string $estatus_did
 * @property string $fechaCreacion_f
 * @property string $almacen_aid
 *
 * The followings are the available model relations:
 * @property Bitacoraalmacenes[] $bitacoraalmacenes
 * @property Inventario[] $inventarios
 * @property Inventario[] $inventarios1
 * @property Inventariolote[] $inventariolotes
 * @property Inventariolote[] $inventariolotes1
 * @property Proveedor[] $proveedors
 * @property Almacen $almacen
 * @property Estatus $estatus
 * @property Tipousuario $tipoUsuario
 */
class Usuario extends CActiveRecord
{
	public $comprobarPass;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usuario the static model class
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
		return 'Usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario', 'length', 'max'=>100),
            array('contrasena', 'length', 'max'=>200),
			array('tipoUsuario_did, estatus_did, almacen_aid', 'length', 'max'=>11),
			array('fechaCreacion_f', 'safe'),
            array('usuario','unique', 'message'=>'El nombre de usuario ya existe, por favor use uno diferente.'),
            array('contrasena', 'compare', 'compareAttribute'=>'comprobarPass','message'=>'Las contraseñas no coinciden, por favor verifique su información.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usuario', 'required','message'=>'El nombre de usuario no puede estar vacio.'),
            array('contrasena', 'required','message'=>'La contraseña no puede estar vacia.'),
            array('comprobarPass', 'required','message'=>'La comprobació de la contraseña no puede estar vacia.'),
            array('id, usuario, contrasena, tipoUsuario_did, estatus_did, fechaCreacion_f, almacen_aid', 'safe', 'on'=>'search'),
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
			'bitacoraalmacenes' => array(self::HAS_MANY, 'Bitacoraalmacenes', 'usuario_did'),
			'inventarios' => array(self::HAS_MANY, 'Inventario', 'usuarioAlta_did'),
			'inventarios1' => array(self::HAS_MANY, 'Inventario', 'usuarioBaja_did'),
			'inventariolotes' => array(self::HAS_MANY, 'Inventariolote', 'usuarioModifico_did'),
			'inventariolotes1' => array(self::HAS_MANY, 'Inventariolote', 'usuarioRegistro_did'),
			'proveedors' => array(self::HAS_MANY, 'Proveedor', 'usuario_did'),
			'almacen' => array(self::BELONGS_TO, 'Almacen', 'almacen_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'tipoUsuario' => array(self::BELONGS_TO, 'Tipousuario', 'tipoUsuario_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario' => 'Usuario',
			'contrasena' => 'Contraseña',
			'tipoUsuario_did' => 'Tipo Usuario',
			'estatus_did' => 'Estatus',
			'fechaCreacion_f' => 'Fecha Creación',
			'almacen_aid' => 'Almacen',
            'comprobarPass' => 'Comp Contraseña'
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
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('contrasena',$this->contrasena,true);
		$criteria->compare('tipoUsuario_did',$this->tipoUsuario_did,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('almacen_aid',$this->almacen_aid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function obtenerUsuarioActual()
	{
		$usuarioActual = Usuario::model()->find('usuario = :u',array(':u' => Yii::app()->user->name));
		return $usuarioActual;
	}
	
	public function obtenerTipoUsuarioActual()
	{
		$usuarioActual = Usuario::model()->find('usuario = :u',array(':u' => Yii::app()->user->name));
		return $usuarioActual->tipoUsuario->nombre;
	}
}