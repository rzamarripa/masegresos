<?php

/**
 * This is the model class for table "Requisicion".
 *
 * The followings are the available columns in table 'Requisicion':
 * @property string $id
 * @property string $numeroRequisicion
 * @property string $fecha_f
 * @property string $unidadOrganizacional_aid
 * @property string $comentarios
 * @property string $director
 * @property string $titular
 * @property string $recibio
 * @property string $entrego
 * @property string $estatus_did
 * @property string $fechaCreacion_f
 *
 * The followings are the available model relations:
 * @property DetalleRequisicion[] $detalleRequisicions
 * @property UnidadOrganizacional $unidadOrganizacional
 * @property Estatus $estatus
 */
class Requisicion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Requisicion the static model class
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
		return 'Requisicion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numeroRequisicion', 'length', 'max'=>20),
			array('unidadOrganizacional_aid, estatus_did, proyecto_aid', 'length', 'max'=>11),
			array('director, titular, recibio, entrego', 'length', 'max'=>100),
			array('fecha_f, comentarios', 'safe'),
			array('id, numeroRequisicion, fecha_f, enpaquete, unidadOrganizacional_aid, proyecto_aid, comentarios, director, titular, recibio, entrego, estatus_did, fechaCreacion_f', 'safe', 'on'=>'search'),
            array('numeroRequisicion', 'required','message'=>'El número de requisición no puede estar vacío.'),
            array('fecha_f', 'required','message'=>'La fecha de la requisición no puede estar vacía.'),
            array('unidadOrganizacional_aid', 'required','message'=>'La unidad organizacional de la requisición no puede estar vacía.'),
            array('numeroRequisicion', 'unique','message'=>'El número de requisición ya esta registrado, por favor revise su información.'),
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
			'detalleRequisicion' => array(self::HAS_MANY, 'DetalleRequisicion', 'requisicion_did'),
			'unidadOrganizacional' => array(self::BELONGS_TO, 'UnidadOrganizacional', 'unidadOrganizacional_aid'),
			'estatus' => array(self::BELONGS_TO, 'Estatus', 'estatus_did'),
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
			'numeroRequisicion' => 'Número Requisición',
			'fecha_f' => 'Fecha',
			'unidadOrganizacional_aid' => 'Unidad Organizacional',
			'comentarios' => 'Comentarios',
			'director' => 'Director',
			'titular' => 'Titular',
			'recibio' => 'Recibió',
			'entrego' => 'Entregó',
			'estatus_did' => 'Estatus',
			'fechaCreacion_f' => 'Fecha Creación',
			'proyecto_aid' => 'Proyecto',
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
		$criteria->compare('numeroRequisicion',$this->numeroRequisicion,true);
		$criteria->compare('fecha_f',$this->fecha_f,true);
		$criteria->compare('unidadOrganizacional_aid',$this->unidadOrganizacional_aid,true);
		$criteria->compare('comentarios',$this->comentarios,true);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('titular',$this->titular,true);
		$criteria->compare('recibio',$this->recibio,true);
		$criteria->compare('entrego',$this->entrego,true);
		$criteria->compare('estatus_did',$this->estatus_did,true);
		$criteria->compare('fechaCreacion_f',$this->fechaCreacion_f,true);
		$criteria->compare('proyecto_aid',$this->proyecto_aid,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function to_array($include_detalle = false) {
		$data = array(
			'id' => $this->id,
			'numeroRequisicion' => $this->numeroRequisicion,
			'fecha' => $this->fecha_f,
			'unidadOrganizacional' => $this->unidadOrganizacional->to_array(),
			'comentarios' => $this->comentarios
		);

		if ($include_detalle) {
			$items = array();
			foreach ($this->detalleRequisicion as $item) {
				$items[] = $item->to_array(array('articulo', 'unidad'));
			}
			$data['detalle'] = $items;
		}
		return $data;
	}
}