<?php

/**
 * This is the model class for table "historial_plan_tratamiento_detalle".
 *
 * The followings are the available columns in table 'historial_plan_tratamiento_detalle':
 * @property integer $id
 * @property integer $historial_plan_tratamiento_id
 * @property integer $linea_servicio_id
 * @property string $observacion
 *
 * The followings are the available model relations:
 * @property HistorialPlanTratamiento $historialPlanTratamiento
 * @property LineaServicio $lineaServicio
 */
class HistorialPlanTratamientoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_plan_tratamiento_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('historial_plan_tratamiento_id, linea_servicio_id, observacion', 'required'),
			array('historial_plan_tratamiento_id, linea_servicio_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, historial_plan_tratamiento_id, linea_servicio_id, observacion', 'safe', 'on'=>'search'),
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
			'historialPlanTratamiento' => array(self::BELONGS_TO, 'HistorialPlanTratamiento', 'historial_plan_tratamiento_id'),
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'historial_plan_tratamiento_id' => 'Historial Plan Tratamiento',
			'linea_servicio_id' => 'Linea Servicio',
			'observacion' => 'Observacion',
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
		$criteria->compare('historial_plan_tratamiento_id',$this->historial_plan_tratamiento_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('observacion',$this->observacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialPlanTratamientoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
