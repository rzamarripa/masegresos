<?php class UnidadOrganizacional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UnidadOrganizacional the static model class
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
		return 'UnidadOrganizacional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo', 'length', 'max'=>11),
			array('nombre', 'length', 'max'=>100),
			array('tipo', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, nombre, tipo', 'safe', 'on'=>'search'),
            array('codigo','required','message'=>'El código de la UO no puede estar vacío.'),
            array('nombre','required','message'=>'El nombre de la UO no puede estar vacío.'),
            array('codigo','unique','message'=>'El código de la UO ya esta registrado, por favor verifique su información.'),
            array('nombre','unique','message'=>'El nombre de la UO ya esta registrado, por favor verifique su información.'),
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
			'espacios' => array(self::HAS_MANY, 'Espacio', 'uO_did'),
			'inventarios' => array(self::HAS_MANY, 'Inventario', 'unidadOrganizacional_aid'),
			'ordenCompras' => array(self::HAS_MANY, 'OrdenCompra', 'unidadOrganizacional_aid'),
			'requisicions' => array(self::HAS_MANY, 'Requisicion', 'unidadOrganizacional_aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'tipo' => 'Tipo',
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
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function to_array() {
		return array(
			'id' => $this->id,
			'nombre' => $this->nombre
		);
	}
}