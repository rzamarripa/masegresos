<?php 

/**
 * This is the model class for table "Contrarecibo".
 *
 * The followings are the available columns in table 'Contrarecibo':
 * @property integer $id
 * @property string $numeroContrarecibo
 * @property string $fecha_f
 * @property string $fechaCreacion_f
 */
class Contrarecibo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contrarecibo the static model class
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
		return 'Contrarecibo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			//array('proveedor_did', 'length', 'max'=>11),
			array('fecha_f', 'required'),
			array('fecha_f', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_f, fechaCreacion_f, proveedor_did', 'safe', 'on'=>'search'),
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
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_f' => 'Fecha',
			'proveedor_did' => 'Proveedor',
			'fechaCreacion_f' => 'Fecha Creación',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('proveedor_did',$this->proveedor_did,false);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);

		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,
			'sort'=>array(
    			'defaultOrder'=>'id DESC',
			),
		));
	}
	
	public function buscar($prov)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('proveedor_did',$prov,false);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}