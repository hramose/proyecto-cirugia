<?php

/**
 * This is the model class for table "historial_laboratorio".
 *
 * The followings are the available columns in table 'historial_laboratorio':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property string $comentarios
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Citas $cita
 * @property HistorialLaboratorioDetalle[] $historialLaboratorioDetalles
 */
class HistorialLaboratorio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_laboratorio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, personal_id, fecha', 'required'),
			array('paciente_id, cita_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, comentarios, fecha', 'safe', 'on'=>'search'),
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
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'historialLaboratorioDetalles' => array(self::HAS_MANY, 'HistorialLaboratorioDetalle', 'historial_laboratorio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'paciente_id' => 'Paciente',
			'cita_id' => 'Cita',
			'comentarios' => 'Comentarios',
			'fecha' => 'Fecha',
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
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('comentarios',$this->comentarios,true);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialLaboratorio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
