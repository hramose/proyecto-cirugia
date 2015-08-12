<?php

/**
 * This is the model class for table "historial_anamnesis".
 *
 * The followings are the available columns in table 'historial_anamnesis':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property integer $personal_id
 * @property string $motivo_consulta
 * @property string $enfermedad_actual
 * @property string $antecedente_patologico
 * @property string $antecedente_quirurgico
 * @property string $antecedente_alergico
 * @property string $antecedente_traumatico
 * @property string $antecedente_medicamento
 * @property string $antecedente_ginecologico
 * @property string $antecedente_fum
 * @property string $antecedente_habitos
 * @property string $antecedente_familiares
 * @property string $antecedente_nutricionales
 * @property string $observaciones_paciente
 * @property string $fecha
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Citas $cita
 * @property Paciente $paciente
 * @property Personal $personal
 */
class HistorialAnamnesis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_anamnesis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id', 'required'),
			array('paciente_id, cita_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, personal_id, motivo_consulta, enfermedad_actual, antecedente_patologico, antecedente_quirurgico, antecedente_alergico, antecedente_traumatico, antecedente_medicamento, antecedente_ginecologico, antecedente_fum, antecedente_habitos, antecedente_familiares, antecedente_nutricionales, observaciones_paciente, fecha, estado', 'safe', 'on'=>'search'),
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
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
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
			'paciente_id' => 'Paciente',
			'cita_id' => 'Cita',
			'personal_id' => 'Personal',
			'motivo_consulta' => 'Motivo Consulta',
			'enfermedad_actual' => 'Enfermedad Actual',
			'antecedente_patologico' => 'Antecedentes Patologicos',
			'antecedente_quirurgico' => 'Antecedentes Quirurgicos',
			'antecedente_alergico' => 'Antecedentes Alergicos',
			'antecedente_traumatico' => 'Antecedentes Traumaticos',
			'antecedente_medicamento' => 'Antecedentes Medicamentos',
			'antecedente_ginecologico' => 'Antecedentes Ginecologicos',
			'antecedente_fum' => 'Antecedentes F.U.M',
			'antecedente_habitos' => 'Antecedentes Habitos',
			'antecedente_familiares' => 'Antecedentes Familiares',
			'antecedente_nutricionales' => 'Antecedentes Nutricionales',
			'observaciones_paciente' => 'Observaciones Paciente',
			'fecha' => 'Fecha',
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
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('motivo_consulta',$this->motivo_consulta,true);
		$criteria->compare('enfermedad_actual',$this->enfermedad_actual,true);
		$criteria->compare('antecedente_patologico',$this->antecedente_patologico,true);
		$criteria->compare('antecedente_quirurgico',$this->antecedente_quirurgico,true);
		$criteria->compare('antecedente_alergico',$this->antecedente_alergico,true);
		$criteria->compare('antecedente_traumatico',$this->antecedente_traumatico,true);
		$criteria->compare('antecedente_medicamento',$this->antecedente_medicamento,true);
		$criteria->compare('antecedente_ginecologico',$this->antecedente_ginecologico,true);
		$criteria->compare('antecedente_fum',$this->antecedente_fum,true);
		$criteria->compare('antecedente_habitos',$this->antecedente_habitos,true);
		$criteria->compare('antecedente_familiares',$this->antecedente_familiares,true);
		$criteria->compare('antecedente_nutricionales',$this->antecedente_nutricionales,true);
		$criteria->compare('observaciones_paciente',$this->observaciones_paciente,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialAnamnesis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
