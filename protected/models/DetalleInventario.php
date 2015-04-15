<?php

/**
 * This is the model class for table "DetalleInventario".
 *
 * The followings are the available columns in table 'DetalleInventario':
 * @property string $id
 * @property integer $tipoCaptura
 * @property string $articulo_aid
 * @property string $marca_aid
 * @property string $modelo
 * @property string $serie
 * @property double $costoAdquisicion
 * @property string $espacio_aid
 * @property string $observaciones
 * @property integer $cantidad
 * @property integer $cantidadPorLote
 * @property string $lote
 * @property string $estatus_did
 * @property string $cantidadPorLoteAct
 * @property double $iva
 * @property double $totalCostoAdquisicion
 * @property double $porcentajeIva
 * @property integer $bajaResguardo
 * @property integer $motivo_did
 *
 * The followings are the available model relations:
 * @property Marcas $marca
 * @property Articulo $articulo
 * @property Espacio $espacio
 */
class DetalleInventario extends CActiveRecord
{	
	/**
	 * Returns the static model of the specified AR class.
	 * @return DetalleInventario the static model class
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
		return 'DetalleInventario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipoCaptura, articulo_aid, funcion_aid, marca_aid, estatus_did, costoAdquisicion, unidadOrganizacional_did', 'required'),
			array('cantidad, cantidadPorLote, cantidadPorLoteAct, bajaResguardo', 'numerical', 'integerOnly'=>true),
			array('costoAdquisicion, iva, totalCostoAdquisicion, porcentajeIva', 'numerical'),
			array('articulo_aid, marca_aid, espacio_aid, funcion_aid, unidadOrganizacional_did, motivo_did', 'length', 'max'=>11),
			array('tipoCaptura, modelo, serie, lote', 'length', 'max'=>100),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipoCaptura, articulo_aid, marca_aid, modelo, serie, costoAdquisicion, espacio_aid, observaciones, cantidad, funcion_aid, cantidadPorLote, lote, estatus_did, cantidadPorLoteAct, unidadOrganizacional_did, bajaResguardo, motivo_did', 'safe', 'on'=>'search'),
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
			'marca' => array(self::BELONGS_TO, 'Marca', 'marca_aid'),
			'articulo' => array(self::BELONGS_TO, 'Articulo', 'articulo_aid'),
			'espacio' => array(self::BELONGS_TO, 'Espacio', 'espacio_aid'),
			'funcion' => array(self::BELONGS_TO, 'Funcion', 'funcion_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
         'inventario' => array(self::BELONGS_TO, 'Inventario', 'inventario_did'),
         'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_did'),
         'motivoBaja' => array(self::BELONGS_TO, 'MotivoBaja', 'motivo_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Num Inventario',
			'tipoCaptura' => 'Tipo Captura',
			'articulo_aid' => 'Artículo',
			'marca_aid' => 'Marca',
			'modelo' => 'Modelo',
			'serie' => 'Serie',
			'costoAdquisicion' => 'Costo Adquisición',
			'espacio_aid' => 'Espacio',
			'observaciones' => 'Observaciones',
			'cantidad' => 'Cantidad',
			'cantidadPorLote' => 'Cantidad Por Lote',
			'lote' => 'Lote',
			'funcion_aid' => 'Función',
			'estatus_did' => 'Estatus',
			'cantidadPorLoteAct' => 'Cantidad Por Lote Actual',
			'iva'=> 'Iva',
			'totalCostoAdquisicion' => 'Total Costo Adquisición',
			'porcentajeIva' => 'Porcentaje de Iva',
			'bajaResguardo' => 'Baja Resguardo',
 			'motivo_did' => 'Motivo de Baja',
 			'unidadOrganizacional_did' => 'Unidad Organizacional',
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
		$criteria->compare('tipoCaptura',$this->tipoCaptura);
		$criteria->compare('articulo_aid',$this->articulo_aid,true);
		$criteria->compare('marca_aid',$this->marca_aid,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('serie',$this->serie,true);
		$criteria->compare('costoAdquisicion',$this->costoAdquisicion);
		$criteria->compare('espacio_aid',$this->espacio_aid,true);
		$criteria->compare('funcion_aid',$this->funcion_aid,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('cantidadPorLote',$this->cantidadPorLote);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('cantidadPorLoteAct',$this->cantidadPorLoteAct);
		$criteria->compare('bajaResguardo',$this->bajaResguardo);
		$criteria->compare('motivo_did',$this->motivo_did);
		$criteria->compare('unidadOrganizacional',$this->unidadOrganizacional_did,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public $tipoBusqueda;
}