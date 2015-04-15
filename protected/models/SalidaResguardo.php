<?php

/**
 * This is the model class for table "SalidaResguardo".
 *
 * The followings are the available columns in table 'SalidaResguardo':
 * @property string $id
 * @property string $autorizo_did
 * @property string $fechaBaja_f
 * @property string $unidadOrganizacional_did
 *
 * The followings are the available model relations:
 * @property Unidadorganizacional $unidadOrganizacionalD
 * @property Usuario $autorizoD
 */
class SalidaResguardo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalidaResguardo the static model class
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
		return 'SalidaResguardo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('autorizo_did, fechaBaja_f, unidadOrganizacional_did', 'required'),
			array('autorizo_did', 'length', 'max'=>10),
			array('unidadOrganizacional_did', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, autorizo_did, fechaBaja_f, unidadOrganizacional_did', 'safe', 'on'=>'search'),
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
			'unidadOrganizacional' => array(self::BELONGS_TO, 'Unidadorganizacional', 'unidadOrganizacional_did'),
			'autorizo' => array(self::BELONGS_TO, 'Usuario', 'autorizo_did'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Salida Resguardo',
			'autorizo_did' => 'Autorizo',
			'fechaBaja_f' => 'Fecha Baja ',
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
		$criteria->compare('autorizo_did',$this->autorizo_did,true);
		$criteria->compare('fechaBaja_f',$this->fechaBaja_f,true);
		$criteria->compare('unidadOrganizacional_did',$this->unidadOrganizacional_did,true);

		$f = Yii::app()->request->getParam('unidadOrganizacional->nombre' , null);
		if(!empty($f)){

 			$activeDataProvider = new CActiveDataProvider($this, array(
            	'criteria'=>$criteria,
        	));

			 $activeDataProvider->getCriteria()->with = array(
                'unidadOrganizacional'
        	);

			$activeDataProvider->getCriteria()->compare('unidadOrganizacional.nombre',$f, true );

			 return $activeDataProvider;

			//$criteria->with('unidadOrganizacional');
   			//$criteria->compare('unidadOrganizacional->nombre' , $f , true);

   		}

   		$a = Yii::app()->request->getParam('autorizo->nombre' , null);
		if(!empty($a)){

 			$activeDataProvider = new CActiveDataProvider($this, array(
            	'criteria'=>$criteria,
        	));

			 $activeDataProvider->getCriteria()->with = array(
                'autorizo'
        	);

			$activeDataProvider->getCriteria()->compare('autorizo.nombre',$a, true );

			 return $activeDataProvider;

			//$criteria->with('unidadOrganizacional');
   			//$criteria->compare('unidadOrganizacional->nombre' , $f , true);

   		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}