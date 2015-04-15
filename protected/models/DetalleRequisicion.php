<?php

/**
 * This is the model class for table "DetalleRequisicion".
 *
 * The followings are the available columns in table 'DetalleRequisicion':
 * @property string $id
 * @property integer $cantidad
 * @property string $unidad_did
 * @property string $articulo_aid
 * @property string $observaciones
 * @property string $requisicion_did
 *
 * The followings are the available model relations:
 * @property Articulo $articulo
 * @property Requisicion $requisicion
 * @property Unidad $unidad
 */
class DetalleRequisicion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DetalleRequisicion the static model class
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
		return 'DetalleRequisicion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad', 'numerical', 'integerOnly'=>true),
			array('unidad_did, articulo_aid, requisicion_did', 'length', 'max'=>11),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cantidad, unidad_did, articulo_aid, observaciones, requisicion_did', 'safe', 'on'=>'search'),
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
			'requisicion' => array(self::BELONGS_TO, 'Requisicion', 'requisicion_did'),
			'unidad' => array(self::BELONGS_TO, 'Unidad', 'unidad_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'unidad_did' => 'Unidad',
			'articulo_aid' => 'Articulo',
			'observaciones' => 'Observaciones',
			'requisicion_did' => 'Requisicion',
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
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('unidad_did',$this->unidad_did,true);
		$criteria->compare('articulo_aid',$this->articulo_aid,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('requisicion_did',$this->requisicion_did,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function to_array($include = array()) {
		$data = array(
			'id' => $this->id,
			'cantidad' => $this->cantidad,			
			'articulo_aid' => $this->articulo_aid,
			'observaciones' => $this->observaciones,
			'requisicion_did' => $this->requisicion_did
		);
		if (in_array('articulo', $include)) {
			$data['articulo'] = $this->articulo->to_array();
		}
		return $data;
	}
}