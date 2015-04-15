<?php

/**
 * This is the model class for table "Inventario".
 *
 * The followings are the available columns in table 'Inventario':
 * @property string $id
 * @property string $unidadOrganizacional_aid
 * @property integer $origen_did
 * @property integer $tipoDocumento_did
 * @property string $numeroDocumento
 * @property string $salidaResguardo
 * @property string $proveedor_aid
 * @property string $fechaAdquisicion_f
 * @property string $ejercicio
 * @property integer $fondo_aid
 * @property string $autorizo
 * @property string $fechaCaptura_f
 * @property integer $estatus_did
 * @property string $fechaBaja_f
 * @property string $usuarioAlta_did
 * @property string $usuarioBaja_did
 *
 * The followings are the available model relations:
 * @property Fondo $fondo
 * @property Usuario $usuarioAlta
 * @property Usuario $usuarioBaja
 * @property TipoOpciones $origen
 * @property Proveedor $proveedor
 * @property TipoOpciones $tipoDocumento
 * @property UnidadOrganizacional $unidadOrganizacional
 */
class Inventario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Inventario the static model class
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
		return 'Inventario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('origen_did, tipoDocumento_did, salidaResguardo, fondo_aid, estatus_did', 'numerical', 'integerOnly'=>true),
			array('unidadOrganizacional_aid, proveedor_aid', 'length', 'max'=>10),
			array('numeroDocumento, ejercicio', 'length', 'max'=>50),
			array('autorizo', 'length', 'max'=>200),
			array('usuarioAlta_did, usuarioBaja_did, salidaResguardo', 'length', 'max'=>11),
			array('fechaAdquisicion_f, fechaCaptura_f, fechaBaja_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, unidadOrganizacional_aid, origen_did, tipoDocumento_did, numeroDocumento, salidaResguardo, proveedor_aid, fechaAdquisicion_f, ejercicio, fondo_aid, autorizo, fechaCaptura_f, estatus_did, fechaBaja_f, usuarioAlta_did, usuarioBaja_did', 'safe', 'on'=>'search'),
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
			'fondo' => array(self::BELONGS_TO, 'Fondo', 'fondo_aid'),
			'usuarioAlta' => array(self::BELONGS_TO, 'Usuario', 'usuarioAlta_did'),
			'usuarioBaja' => array(self::BELONGS_TO, 'Usuario', 'usuarioBaja_did'),
			'origen' => array(self::BELONGS_TO, 'TipoOpciones', 'origen_did'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_aid'),
			'tipoDocumento' => array(self::BELONGS_TO, 'TipoOpciones', 'tipoDocumento_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_aid'),
			'funcion' => array(self::BELONGS_TO, 'Funcion', 'funcion_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'unidadOrganizacional_aid' => 'Unidad Organizacional',
			'origen_did' => 'Origen',
			'tipoDocumento_did' => 'Tipo Documento',
			'numeroDocumento' => 'Número Documento',
			'salidaResguardo' => 'Salida Resguardo',
			'proveedor_aid' => 'Proveedor',
			'fechaAdquisicion_f' => 'Fecha Adquisición',
			'ejercicio' => 'Ejercicio',
			'fondo_aid' => 'Fondo',
			'autorizo' => 'Autorizó',
			'fechaCaptura_f' => 'Fecha Captura',
			'estatus_did' => 'Estatus',
			'fechaBaja_f' => 'Fecha Baja',
			'usuarioAlta_did' => 'Usuario Alta',
			'usuarioBaja_did' => 'Usuario Baja',
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
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,true);
		$criteria->compare('origen_did',$this->origen_did);
		$criteria->compare('tipoDocumento_did',$this->tipoDocumento_did);
		$criteria->compare('numeroDocumento',$this->numeroDocumento,true);
		$criteria->compare('salidaResguardo',$this->salidaResguardo,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,true);
		$criteria->compare('fechaAdquisicion_f',$this->fechaAdquisicion_f,true);
		$criteria->compare('ejercicio',$this->ejercicio,true);
		$criteria->compare('fondo_aid',$this->fondo_aid);
		$criteria->compare('autorizo',$this->autorizo,true);
		$criteria->compare('fechaCaptura_f',$this->fechaCaptura_f,true);
		$criteria->compare('estatus_did',$this->estatus_did);
		$criteria->compare('fechaBaja_f',$this->fechaBaja_f,true);
		$criteria->compare('usuarioAlta_did',$this->usuarioAlta_did,true);
		$criteria->compare('usuarioBaja_did',$this->usuarioBaja_did,true);

		$f = Yii::app()->request->getParam('unidadOrganizacional->nombre' , null);
		if(!empty($f)){

 			$activeDataProvider = new CActiveDataProvider($this, array(
            	'criteria'=>$criteria,
        	));

			 $activeDataProvider->getCriteria()->with = array(
                'unidadOrganizacional'
        	);

			$activeDataProvider->getCriteria()->compare('unidadOrganizacional.nombre',$f, true );

			 return $activeDataProvider;

			//$criteria->with('unidadOrganizacional');
   			//$criteria->compare('unidadOrganizacional->nombre' , $f , true);

   		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}