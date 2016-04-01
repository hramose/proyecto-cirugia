<?php

/**
 * This is the model class for table "paciente_nuevo_contrato".
 *
 * The followings are the available columns in table 'paciente_nuevo_contrato':
 * @property integer $paciente_id
 * @property string $nombre
 * @property string $apellido
 * @property string $n_identificacion
 * @property integer $contrato_id
 * @property string $total
 * @property integer $cita_id
 * @property integer $linea_servicio_id
 */
class PacienteNuevoContrato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente_nuevo_contrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total, linea_servicio_id', 'required'),
			array('paciente_id, contrato_id, cita_id, linea_servicio_id', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido, n_identificacion', 'length', 'max'=>254),
			array('total', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('paciente_id, nombre, apellido, n_identificacion, contrato_id, total, cita_id, linea_servicio_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paciente_id' => 'Paciente',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'n_identificacion' => 'N Identificacion',
			'contrato_id' => 'Contrato',
			'total' => 'Total',
			'cita_id' => 'Cita',
			'linea_servicio_id' => 'Linea Servicio',
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

		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PacienteNuevoContrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
