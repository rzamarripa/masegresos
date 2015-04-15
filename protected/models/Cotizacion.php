<?php

/**
 * This is the model class for table "Cotizacion".
 *
 * The followings are the available columns in table 'Cotizacion':
 * @property string $id
 * @property string $numeroCotizacion
 * @property string $fecha_f
 * @property string $director
 * @property double $subtotal
 * @property double $iva
 * @property double $total
 * @property string $estatus_did
 * @property string $requisicion_did
 * @property string $fechaCreacion_f
 * @property string $proveedor_aid
 *
 * The followings are the available model relations:
 * @property Proveedor $proveedor
 * @property Estatus $estatus
 * @property Requisicion $requisicion
 * @property DetalleCotizacion[] $detalleCotizacions
 * @property ProveedoresPorCotizacion[] $proveedoresPorCotizacions
 */
class Cotizacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cotizacion the static model class
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
		return 'Cotizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estatus_did, fechaEntrega_f', 'required'),
			array('subtotal, iva, total', 'numerical'),
			array('numeroCotizacion', 'length', 'max'=>20),
			array('director', 'length', 'max'=>100),
			array('estatus_did, requisicion_did, proyecto_aid, proveedor_aid', 'length', 'max'=>11),
			array('fecha_f, fechaCreacion_f, fechaEntrega_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, numeroCotizacion, fecha_f, director, subtotal, iva, total, estatus_did, requisicion_did, fechaCreacion_f, fechaEntrega_f, proveedor_aid, proyecto_aid', 'safe', 'on'=>'search'),
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
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'requisicion' => array(self::BELONGS_TO, 'Requisicion', 'requisicion_did'),
			'detalleCotizacions' => array(self::HAS_MANY, 'DetalleCotizacion', 'cotizacion_did'),
			'proveedoresPorCotizacions' => array(self::HAS_MANY, 'ProveedoresPorCotizacion', 'cotizacion_aid'),
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
			'numeroCotizacion' => 'No. Cotización',
			'fecha_f' => 'Fecha',
			'director' => 'Director',
			'subtotal' => 'Subtotal',
			'iva' => 'Iva',
			'total' => 'Total',
			'estatus_did' => 'Estatus',
			'requisicion_did' => 'Requisición',
			'fechaCreacion_f' => 'Fecha Creación',
			'fechaEntrega_f' => 'Fecha de Entrega',
			'proveedor_aid' => 'Proveedor',
			'proyecto_aid' => 'Proyecto',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($proveedorId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        $criteria->together = true;
        
		$criteria->compare('id',$this->id,true);
		$criteria->compare('numeroCotizacion',$this->numeroCotizacion,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('requisicion_did',$this->requisicion_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('fechaEntrega_f',$this->fechaEntrega_f,true);
		$criteria->compare('proveedor_aid',$proveedorId,true);
		$criteria->compare('proyecto_aid',$this->proyecto_aid,true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
	public function searchAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        $criteria->together = true;
        
		$criteria->compare('id',$this->id,true);
		$criteria->compare('numeroCotizacion',$this->numeroCotizacion,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('requisicion_did',$this->requisicion_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('fechaEntrega_f',$this->fechaEntrega_f,true);
		$criteria->compare('proveedor_aid',$this->proveedor_aid,true);
		$criteria->compare('proyecto_aid',$this->proyecto_aid,true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function formatMoney($number, $fractional=false) 
    { 
	    if ($fractional) { 
	        $number = sprintf('%.2f', $number); 
	    } 
	    while (true) { 
	        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
	        if ($replaced != $number) { 
	            $number = $replaced; 
	        } else { 
	            break; 
	        } 
	    } 
	    return $number; 
	} 
    
    public function formatCurrency($number, $fractional=false) 
    { 
	    if ($fractional) { 
	        $number = sprintf('%.2f', $number); 
	    } 
	    while (true) { 
	        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
	        if ($replaced != $number) { 
	            $number = $replaced; 
	        } else { 
	            break; 
	        } 
	    } 
	    return '$ '.$number; 
	} 
}