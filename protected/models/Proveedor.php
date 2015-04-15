<?php

/**
 * This is the model class for table "Proveedor".
 *
 * The followings are the available columns in table 'Proveedor':
 * @property string $id
 * @property string $codigo
 * @property string $nombre
 * @property string $direccion
 * @property string $usuario_did
 * @property string $estatus_did
 * @property string $fechaCreacion_f
 * @property string $rfc
 *
 * The followings are the available model relations:
 * @property Contrarecibo[] $contrarecibos
 * @property Cotizacion[] $cotizacions
 * @property OrdenCompra[] $ordenCompras
 * @property Estatus $estatus
 * @property Usuario $usuario
 * @property ProveedoresPorRequisicion[] $proveedoresPorRequisicions
 */
class Proveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Proveedor the static model class
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
		return 'Proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo', 'length', 'max'=>20),
			array('nombre, correo, direccion', 'length', 'max'=>200),
			array('usuario_did, estatus_did', 'length', 'max'=>11),
			array('rfc', 'length', 'max'=>45),
			array('fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, correo, nombre, direccion, usuario_did, estatus_did, fechaCreacion_f, rfc', 'safe', 'on'=>'search'),
            array('codigo','required','message'=>'El código del proveedor no puede estar vacio.'),
            array('nombre','required','message'=>'El nombre del proveedor no puede estar vacio.'),
            array('rfc','required','message'=>'El RFC del proveedor no puede estar vacio.'),
            array('usuario_did','required','message'=>'El usuario del proveedor no puede estar vacio.'),
            array('codigo','unique', 'message'=>'El código del proveedor ya existe, por favor use uno diferente.'),
            //array('rfc','unique', 'message'=>'El RFC del proveedor ya existe, por favor verifique su información.'),
		);
	}

        public $pagado;
        public $pasivo;
    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contrarecibos' => array(self::HAS_MANY, 'Contrarecibo', 'proveedor_did'),
			'cotizacions' => array(self::HAS_MANY, 'Cotizacion', 'proveedor_aid'),
			'ordenCompras' => array(self::HAS_MANY, 'OrdenCompra', 'proveedor_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_did'),
			'proveedoresPorRequisicions' => array(self::HAS_MANY, 'ProveedoresPorRequisicion', 'proveedor_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Código',
			'nombre' => 'Nombre',
			'direccion' => 'Dirección',
			'usuario_did' => 'Usuario',
			'estatus_did' => 'Estatus',
			'fechaCreacion_f' => 'Fecha Creación',
			'rfc' => 'RFC',
			'correo' => 'Correo',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('usuario_did',$this->usuario_did,false);
		$criteria->compare('estatus_did',$this->estatus_did,false);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('rfc',$this->rfc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize'=>6,
			)
		));
	}
	
    public function obtenerPasivoProveedores()
	{
		$criteria=new CDbCriteria;

        $criteria->alias = 'p';
        
        $criteria->select = 'p.nombre
        					, concat("$ ", ifnull(format(sum(dcp.totalFactura), 2),0.00)) as pasivo
        					, concat("$ ", ifnull(format(sum(dcpa.totalFactura), 2),0.00)) as pagado';
        
        $criteria->join = '
	        				inner join Contrarecibo as c 
	    						on p.id = c.proveedor_did 
							left join DetalleContrarecibo as dcp 
								on dcp.contrarecibo_did = c.id
								and dcp.estatus_did = 1
							left join DetalleContrarecibo as dcpa 
								on dcpa.contrarecibo_did = c.id
								and dcpa.estatus_did = 2';
        
        $criteria->group = 'p.id';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize'=>5,
			)
		));
	}
	
	public function obtenerProveedorActual()
	{
		$usuarioActual = Usuario::model()->find("usuario = '" . Yii::app()->user->name . "'");
		$proveedorActual = Proveedor::model()->find("usuario_did = " . $usuarioActual->id);
		return $proveedorActual;
	}
}