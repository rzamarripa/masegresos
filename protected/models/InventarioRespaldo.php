<?php

/**
 * This is the model class for table "Inventario".
 *
 * The followings are the available columns in table 'Inventario':
 id
 codigoInventario
 unidadOrganizacional_aid
 origen_did
 tipoDocumento_did
 numeroDocumento
 salidaResguardo
 proveedor_aid
 articulo_aid
 fechaAdquisicion_f
 costoAdquisicion
 ejercicio
 serie
 cantidad
 observaciones
 fondo_aid
 espacio_aid
 autorizo
 fechaRegistro_f
 esLote
 lote
 cantidadPorLote
 estatus
 fechaBaja_f
 usuarioAlta_did
 usuarioBaja_did
 *
 * The followings are the available model relations:
 * @property Articulo $articulo
 * @property Usuario $autorizo
 * @property Espacio $espacio
 * @property Fondo $fondo
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
			
			array('codigoInventario, origen_did, tipoDocumento_did, fondo_aid, usuarioAlta_did, usuarioBaja_did', 'numerical', 'integerOnly'=>true),
			array('costoAdquisicion, estatus, esLote', 'numerical'),
			array('unidadOrganizacional_aid, proveedor_aid, cantidad, funcion_aid, espacio_aid, cantidadPorLote', 'length', 'max'=>10),
			array('numeroDocumento, salidaResguardo, ejercicio', 'length', 'max'=>50),
			array('articulo_aid', 'length', 'max'=>11),
			array('serie, modelo', 'length', 'max'=>45),
			array('lote', 'length', 'max'=>20),
			array('observaciones', 'length', 'max'=>500),
            array('autorizo', 'length', 'max'=>200),
			array('fechaAdquisicion_f, fechaRegistro_f, fechaBaja_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigoInventario, unidadOrganizacional_aid, origen_did, tipoDocumento_did, numeroDocumento, salidaResguardo, proveedor_aid, articulo_aid', 'safe', 'on'=>'search'),
            array('fechaAdquisicion_f, funcion_aid, costoAdquisicion, ejercicio, serie, cantidad, observaciones, fondo_aid, espacio_aid, autorizo, fechaRegistro_f', 'safe', 'on'=>'search'),
            //array('estatus, fechaBaja_f, usuarioAlta_did, usuarioBaja_did', 'safe', 'on'=>'search'),
            array('origen_did, tipoDocumento_did, articulo_aid, numeroDocumento, proveedor_aid, unidadOrganizacional_aid','required'),
            array('fechaAdquisicion_f, fechaRegistro_f, costoAdquisicion, serie, ejercicio, funcion_aid, fondo_aid','required')
            //array('estatus, fechaBaja_f, usuarioAlta_did, usuarioBaja_did','required')
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
			'articulo' => array(self::BELONGS_TO, 'Articulo', 'articulo_aid'),
			'espacio' => array(self::BELONGS_TO, 'Espacio', 'espacio_aid'),
			'fondo' => array(self::BELONGS_TO, 'Fondo', 'fondo_aid'),
			'origen' => array(self::BELONGS_TO, 'TipoOpciones', 'origen_did'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_aid'),
			'tipoDocumento' => array(self::BELONGS_TO, 'TipoOpciones', 'tipoDocumento_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_aid'),
			'funcion' => array(self::BELONGS_TO, 'Funcion', 'funcion_aid'),
			'usuarioAlta' => array(self::BELONGS_TO, 'Usuario', 'usuarioAlta_did'),
			'usuarioBaja' => array(self::BELONGS_TO, 'Usuario', 'usuarioBaja_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigoInventario' => 'Código Inventario',
			'unidadOrganizacional_aid' => 'Unidad Organizacional',
			'origen_did' => 'Origen',
			'tipoDocumento_did' => 'Tipo Documento',
			'numeroDocumento' => 'Número Documento',
			'salidaResguardo' => 'Salida Resguardo',
			'proveedor_aid' => 'Proveedor',
			'articulo_aid' => 'Artículo',
			'fechaAdquisicion_f' => 'Fecha Adquisición',
			'costoAdquisicion' => 'Costo Adquisición',
			'ejercicio' => 'Ejercicio',
			'serie' => 'Serie',
			'cantidad' => 'Cantidad',
			'observaciones' => 'Observaciones',
			'fondo_aid' => 'Fondo',
			'espacio_aid' => 'Espacio',
			'autorizo' => 'Autorizó',
			'fechaRegistro_f' => 'Fecha Registro',
			'funcion_aid' => 'Espacio',
			'esLote' => 'Es Lote',
			'lote' => 'Lote',
			'cantidadPorLote' => 'Cant Por Lote',
			'modelo' => 'Modelo',
			'estatus' => 'Estatus',
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
		$criteria->compare('codigoInventario',$this->codigoInventario);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,true);
		$criteria->compare('origen_did',$this->origen_did);
		$criteria->compare('tipoDocumento_did',$this->tipoDocumento_did);
		$criteria->compare('numeroDocumento',$this->numeroDocumento,true);
		$criteria->compare('salidaResguardo',$this->salidaResguardo,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,true);
		$criteria->compare('articulo_aid',$this->articulo_aid,true);
		$criteria->compare('fechaAdquisicion_f',$this->fechaAdquisicion_f,true);
		$criteria->compare('costoAdquisicion',$this->costoAdquisicion);
		$criteria->compare('ejercicio',$this->ejercicio,true);
		$criteria->compare('serie',$this->serie,true);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('fondo_aid',$this->fondo_aid,true);
		$criteria->compare('espacio_aid',$this->espacio_aid,true);
		$criteria->compare('autorizo',$this->autorizo,true);
		$criteria->compare('fechaRegistro_f',$this->fechaRegistro_f,true);
		$criteria->compare('esLote',$this->esLote,true);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('cantidadPorLote',$this->cantidadPorLote,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('estatus',$this->estatus,true);
		$criteria->compare('fechaBaja_f',$this->fechaBaja_f,true);
		$criteria->compare('usuarioAlta_did',$this->usuarioAlta_did,true);
		$criteria->compare('usuarioBaja_did',$this->usuarioBaja_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public $tipoCaptura;
    
    public function cargarTipoDeCapturas() {
            return array(
                    1=>'Carga Normal',
                    2=>'Carga x Lote',
            );
    }
}