<?php

/**
 * This is the model class for table "activo_observaciones".
 *
 * The followings are the available columns in table 'activo_observaciones':
 * @property integer $id
 * @property integer $activo_inventario_id
 * @property string $estado
 * @property string $observacion
 * @property string $fecha
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property ActivoInventario $activoInventario
 * @property Personal $personal
 */
class ActivoObservaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activo_observaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activo_inventario_id, estado, observacion, fecha', 'required'),
			array('activo_inventario_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, activo_inventario_id, estado, observacion, fecha, personal_id', 'safe', 'on'=>'search'),
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
			'activoInventario' => array(self::BELONGS_TO, 'ActivoInventario', 'activo_inventario_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'activo_inventario_id' => 'Activo Inventario',
			'estado' => 'Estado',
			'observacion' => 'Observacion',
			'fecha' => 'Fecha',
			'personal_id' => 'Personal',
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
		$criteria->compare('activo_inventario_id',$this->activo_inventario_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('observacion',$this->observacion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivoObservaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
