<?php

/**
 * This is the model class for table "historial_descripcion_quirurgica".
 *
 * The followings are the available columns in table 'historial_descripcion_quirurgica':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property string $servicio
 * @property string $diagnostico_preoperatorio
 * @property string $diagnostico_posoperatorio
 * @property integer $cirujano_id
 * @property integer $ayudante_id
 * @property integer $anestesiologo_id
 * @property integer $inst_quirurgico_id
 * @property string $fecha_cirugia
 * @property string $hora_inicio
 * @property string $hora_final
 * @property string $codigo_cups
 * @property string $intervencion
 * @property string $control_compresas
 * @property string $tipo_anestesia
 * @property string $descripcion_hallazgos
 * @property integer $personal_id
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Citas $cita
 * @property Paciente $paciente
 * @property Personal $cirujano
 * @property Personal $ayudante
 * @property Personal $anestesiologo
 * @property Personal $instQuirurgico
 * @property Personal $personal
 */
class HistorialDescripcionQuirurgica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_descripcion_quirurgica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicio, diagnostico_preoperatorio, diagnostico_posoperatorio, cirujano_id, inst_quirurgico_id, fecha_cirugia, hora_inicio, hora_final, intervencion, control_compresas, tipo_anestesia, descripcion_hallazgos, personal_id, fecha', 'required'),
			array('paciente_id, cita_id, cirujano_id, ayudante_id, anestesiologo_id, inst_quirurgico_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('servicio', 'length', 'max'=>75),
			array('hora_inicio, hora_final', 'length', 'max'=>7),
			array('codigo_cups, control_compresas', 'length', 'max'=>25),
			array('intervencion, tipo_anestesia', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, servicio, observaciones, diagnostico_preoperatorio, diagnostico_posoperatorio, cirujano_id, ayudante_id, anestesiologo_id, inst_quirurgico_id, fecha_cirugia, hora_inicio, hora_final, codigo_cups, intervencion, control_compresas, tipo_anestesia, descripcion_hallazgos, personal_id, fecha', 'safe', 'on'=>'search'),
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
			'cirujano' => array(self::BELONGS_TO, 'Personal', 'cirujano_id'),
			'ayudante' => array(self::BELONGS_TO, 'Personal', 'ayudante_id'),
			'anestesiologo' => array(self::BELONGS_TO, 'Personal', 'anestesiologo_id'),
			'instQuirurgico' => array(self::BELONGS_TO, 'Personal', 'inst_quirurgico_id'),
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
			'servicio' => 'Servicio',
			'diagnostico_preoperatorio' => 'Diagnostico Preoperatorio',
			'diagnostico_posoperatorio' => 'Diagnostico Posoperatorio',
			'cirujano_id' => 'Cirujano',
			'ayudante_id' => 'Ayudante',
			'anestesiologo_id' => 'Anestesiologo',
			'inst_quirurgico_id' => 'Inst Quirurgico',
			'fecha_cirugia' => 'Fecha Cirugia',
			'hora_inicio' => 'Hora Inicio',
			'hora_final' => 'Hora Final',
			'codigo_cups' => 'Codigo Cups',
			'intervencion' => 'Intervencion',
			'control_compresas' => 'Control Compresas',
			'tipo_anestesia' => 'Tipo Anestesia',
			'descripcion_hallazgos' => 'Descripcion Hallazgos',
			'personal_id' => 'Personal',
			'fecha' => 'Fecha',
			'observaciones' => 'Observaciones',
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
		$criteria->compare('servicio',$this->servicio,true);
		$criteria->compare('diagnostico_preoperatorio',$this->diagnostico_preoperatorio,true);
		$criteria->compare('diagnostico_posoperatorio',$this->diagnostico_posoperatorio,true);
		$criteria->compare('cirujano_id',$this->cirujano_id);
		$criteria->compare('ayudante_id',$this->ayudante_id);
		$criteria->compare('anestesiologo_id',$this->anestesiologo_id);
		$criteria->compare('inst_quirurgico_id',$this->inst_quirurgico_id);
		$criteria->compare('fecha_cirugia',$this->fecha_cirugia,true);
		$criteria->compare('hora_inicio',$this->hora_inicio,true);
		$criteria->compare('hora_final',$this->hora_final,true);
		$criteria->compare('codigo_cups',$this->codigo_cups,true);
		$criteria->compare('intervencion',$this->intervencion,true);
		$criteria->compare('control_compresas',$this->control_compresas,true);
		$criteria->compare('tipo_anestesia',$this->tipo_anestesia,true);
		$criteria->compare('descripcion_hallazgos',$this->descripcion_hallazgos,true);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialDescripcionQuirurgica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
