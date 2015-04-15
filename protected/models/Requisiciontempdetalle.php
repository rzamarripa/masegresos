<?php

/**
 * This is the model class for table "requisiciontempdetalle".
 *
 * The followings are the available columns in table 'requisiciontempdetalle':
 * @property string $id
 * @property string $requisicionTemp_did
 * @property integer $cantidad
 * @property string $articulo
 * @property string $unidad_did
 * @property string $usuario_did
 * @property string $fechaCreacion_f
 *
 * The followings are the available model relations:
 * @property Requisiciontemp $requisicionTemp
 * @property Unidad $unidad
 * @property Usuario $usuario
 */
class Requisiciontempdetalle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Requisiciontempdetalle the static model class
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
		return 'requisiciontempdetalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requisicionTemp_did, cantidad, articulo, usuario_did, unidad_did', 'required'),
			array('cantidad', 'numerical', 'integerOnly'=>true),
			array('requisicionTemp_did, unidad_did, usuario_did', 'length', 'max'=>11),
			array('articulo, comentarios', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, requisicionTemp_did, cantidad, comentarios, articulo, unidad_did, usuario_did, fechaCreacion_f', 'safe', 'on'=>'search'),
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
			'requisicionTemp' => array(self::BELONGS_TO, 'Requisiciontemp', 'requisicionTemp_did'),
			'unidad' => array(self::BELONGS_TO, 'Unidad', 'unidad_did'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'requisicionTemp_did' => 'Requisición Temp',
			'cantidad' => 'Cantidad',
			'articulo' => 'Artículo',
			'unidad_did' => 'Unidad',
			'usuario_did' => 'Usuario',
			'comentarios' => 'Comentarios',
			'fechaCreacion_f' => 'Fecha Creacion F',
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
		$criteria->compare('requisicionTemp_did',$this->requisicionTemp_did,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('articulo',$this->articulo,true);
		$criteria->compare('unidad_did',$this->unidad_did,true);
		$criteria->compare('usuario_did',$this->usuario_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}