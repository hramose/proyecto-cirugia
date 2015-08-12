<?php

/**
 * This is the model class for table "activo_inventario".
 *
 * The followings are the available columns in table 'activo_inventario':
 * @property integer $id
 * @property integer $activo_tipo_id
 * @property string $nombre
 * @property string $marca
 * @property string $modelo
 * @property string $serial
 * @property string $caracteristicas
 * @property string $ubicacion
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property ActivosTipo $activoTipo
 */
class ActivoInventario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_inventario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activo_tipo_id, nombre, marca, modelo, serial, caracteristicas, ubicacion, estado', 'required'),
			array('activo_tipo_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>40),
			array('marca, modelo', 'length', 'max'=>25),
			array('serial, ubicacion', 'length', 'max'=>50),
			array('estado', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, activo_tipo_id, nombre, marca, modelo, serial, caracteristicas, ubicacion, estado', 'safe', 'on'=>'search'),
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
			'activoTipo' => array(self::BELONGS_TO, 'ActivosTipo', 'activo_tipo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'activo_tipo_id' => 'Tipo de Activo',
			'nombre' => 'Nombre',
			'marca' => 'Marca',
			'modelo' => 'Modelo',
			'serial' => 'Serial',
			'caracteristicas' => 'Caracteristicas',
			'ubicacion' => 'Ubicación',
			'estado' => 'Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('activo_tipo_id',$this->activo_tipo_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('serial',$this->serial,true);
		$criteria->compare('caracteristicas',$this->caracteristicas,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoInventario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
