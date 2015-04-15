<?php

/**
 * This is the model class for table "Articulo".
 *
 * The followings are the available columns in table 'Articulo':
 * @property string $id
 * @property string $codigo
 * @property string $nombre
 * @property string $unidad_did
 *
 * The followings are the available model relations:
 * @property Unidad $unidad
 * @property DetalleCotizacion[] $detalleCotizacions
 * @property DetalleOrdenCompra[] $detalleOrdenCompras
 * @property DetalleRequisicion[] $detalleRequisicions
 */
class Articulo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Articulo the static model class
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
		return 'Articulo';
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
			array('nombre', 'length', 'max'=>200),
			array('unidad', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('codigo','unique', 'message'=>'El código del articulo ya existe, por favor use uno diferente.'),
			array('id, codigo, nombre, unidad', 'safe', 'on'=>'search'),
            array('codigo', 'required','message'=>'El código del artículo no puede estar vacio.'),
            array('nombre', 'required','message'=>'El nombre del artículo no puede estar vacio.'),
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
			'detalleCotizacions' => array(self::HAS_MANY, 'DetalleCotizacion', 'articulo_aid'),
			'detalleOrdenCompras' => array(self::HAS_MANY, 'DetalleOrdenCompra', 'articulo_aid'),
			'detalleRequisicions' => array(self::HAS_MANY, 'DetalleRequisicion', 'articulo_aid'),
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
			'unidad' => 'Unidad',
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
		$criteria->compare('unidad',$this->unidad,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function display_name() {
		return "{$this->codigo} - {$this->nombre}";
	}

	public function to_array() {
		return array(
			'id' => $this->id,
			'nombre' => $this->nombre,
			'display_name' => $this->display_name(),
			'unidad' => $this->unidad
		);
	}
}