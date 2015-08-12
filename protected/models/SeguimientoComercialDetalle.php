<?php

/**
 * This is the model class for table "seguimiento_comercial_detalle".
 *
 * The followings are the available columns in table 'seguimiento_comercial_detalle':
 * @property integer $id
 * @property integer $seguimiento_comercial_id
 * @property string $fecha_seguimiento
 * @property string $seguimiento
 * @property integer $responsable_id
 * @property string $fecha_registro
 *
 * The followings are the available model relations:
 * @property Personal $responsable
 * @property SeguimientoComercial $seguimientoComercial
 */
class SeguimientoComercialDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguimiento_comercial_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seguimiento_comercial_id, fecha_seguimiento, seguimiento, responsable_id, fecha_registro', 'required'),
			array('seguimiento_comercial_id, responsable_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, seguimiento_comercial_id, fecha_seguimiento, seguimiento, responsable_id, fecha_registro', 'safe', 'on'=>'search'),
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
			'responsable' => array(self::BELONGS_TO, 'Personal', 'responsable_id'),
			'seguimientoComercial' => array(self::BELONGS_TO, 'SeguimientoComercial', 'seguimiento_comercial_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'seguimiento_comercial_id' => 'Seguimiento Comercial',
			'fecha_seguimiento' => 'Fecha Seguimiento',
			'seguimiento' => 'Seguimiento',
			'responsable_id' => 'Responsable',
			'fecha_registro' => 'Fecha Registro',
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
		$criteria->compare('seguimiento_comercial_id',$this->seguimiento_comercial_id);
		$criteria->compare('fecha_seguimiento',$this->fecha_seguimiento,true);
		$criteria->compare('seguimiento',$this->seguimiento,true);
		$criteria->compare('responsable_id',$this->responsable_id);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeguimientoComercialDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
