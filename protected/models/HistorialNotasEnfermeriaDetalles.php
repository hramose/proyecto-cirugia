<?php

/**
 * This is the model class for table "historial_notas_enfermeria_detalles".
 *
 * The followings are the available columns in table 'historial_notas_enfermeria_detalles':
 * @property integer $id
 * @property integer $historial_notas_enfermeria_id
 * @property string $fecha
 * @property string $hora
 * @property string $nota
 *
 * The followings are the available model relations:
 * @property HistorialNotasEnfermeria $historialNotasEnfermeria
 */
class HistorialNotasEnfermeriaDetalles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_notas_enfermeria_detalles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('historial_notas_enfermeria_id, fecha, hora, nota', 'required'),
			array('historial_notas_enfermeria_id', 'numerical', 'integerOnly'=>true),
			array('hora', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, historial_notas_enfermeria_id, fecha, hora, nota', 'safe', 'on'=>'search'),
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
			'historialNotasEnfermeria' => array(self::BELONGS_TO, 'HistorialNotasEnfermeria', 'historial_notas_enfermeria_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'historial_notas_enfermeria_id' => 'Historial Notas Enfermeria',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'nota' => 'Nota',
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
		$criteria->compare('historial_notas_enfermeria_id',$this->historial_notas_enfermeria_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('nota',$this->nota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialNotasEnfermeriaDetalles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
