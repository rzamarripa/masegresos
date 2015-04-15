<?php 

/**
 * This is the model class for table "DetalleContrarecibo".
 *
 * The followings are the available columns in table 'DetalleContrarecibo':
 * @property string $id
 * @property string $contrarecibo_did
 * @property string $ordenCompra_did
 * @property string $numeroOrdenCompra
 * @property string $fechaOrdenCompra_f
 * @property double $subtotal
 * @property double $iva
 * @property double $total
 * @property string $numeroFactura
 * @property string $fechaFactura_f
 * @property double $totalFactura
 * @property string $fechaCreacion_f
 *
 * The followings are the available model relations:
 * @property OrdenCompra $ordenCompra
 * @property Contrarecibo $contrarecibo
 */
class DetalleContrarecibo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DetalleContrarecibo the static model class
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
		return 'DetalleContrarecibo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subtotal, iva, total, totalFactura', 'numerical'),
			array('contrarecibo_did, ordenCompra_did', 'length', 'max'=>11),
			array('numeroOrdenCompra, numeroFactura, cheque', 'length', 'max'=>100),
			array('fechaOrdenCompra_f, fechaFactura_f, fechaCreacion_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contrarecibo_did, ordenCompra_did, numeroOrdenCompra, fechaOrdenCompra_f, subtotal, iva, total, numeroFactura, fechaFactura_f, totalFactura, fechaCreacion_f, cheque', 'safe', 'on'=>'search'),
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
			'ordenCompra' => array(self::BELONGS_TO, 'OrdenCompra', 'ordenCompra_did'),
			'contrarecibo' => array(self::BELONGS_TO, 'Contrarecibo', 'contrarecibo_did'),
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
			'contrarecibo_did' => 'Contrarecibo',
			'ordenCompra_did' => 'Orden Compra',
			'numeroOrdenCompra' => 'Numero Orden Compra',
			'fechaOrdenCompra_f' => 'Fecha Orden Compra F',
			'subtotal' => 'Subtotal',
			'iva' => 'Iva',
			'total' => 'Total',
			'numeroFactura' => 'Numero Factura',
			'fechaFactura_f' => 'Fecha Factura F',
			'totalFactura' => 'Total Factura',
			'fechaCreacion_f' => 'Fecha Creacion F',
			'cheque' => 'Cheque',
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
		$criteria->compare('contrarecibo_did',$this->contrarecibo_did,true);
		$criteria->compare('ordenCompra_did',$this->ordenCompra_did,true);
		$criteria->compare('numeroOrdenCompra',$this->numeroOrdenCompra,true);
		$criteria->compare('fechaOrdenCompra_f',$this->fechaOrdenCompra_f,true);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('total',$this->total);
		$criteria->compare('numeroFactura',$this->numeroFactura,true);
		$criteria->compare('fechaFactura_f',$this->fechaFactura_f,true);
		$criteria->compare('totalFactura',$this->totalFactura);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('cheque',$this->cheque,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function to_array() {
		return array(
			'id' => $this->id,
			'contrarecibo_did' => $this->contrarecibo_did,
			'ordenCompra_did' => $this->ordenCompra_did,
			'numeroOrdenCompra' => $this->numeroOrdenCompra,
			'fechaOrdenCompra_f' => $this->fechaOrdenCompra_f,
			'subtotal' => $this->subtotal,
			'iva' => $this->iva,
			'total' => $this->total,
			'facturas' => array(
				array(
					'numeroFactura' => $this->numeroFactura,
					'fechaFactura_f' => $this->fechaFactura_f,
					'totalFactura' => $this->totalFactura
				)
			)
		);
	}

	public function factura_to_array() {
		return array(
			'numeroFactura' => $this->numeroFactura,
			'fechaFactura_f' => $this->fechaFactura_f,
			'totalFactura' => $this->totalFactura
		);
	}
}