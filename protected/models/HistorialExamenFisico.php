<?php

/**
 * This is the model class for table "historial_examen_fisico".
 *
 * The followings are the available columns in table 'historial_examen_fisico':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property integer $personal_id
 * @property integer $diagnostico_principal_id
 * @property integer $diagnostico_relacionado_id
 * @property string $peso
 * @property string $altura
 * @property string $imc
 * @property string $cabeza_cuello
 * @property string $cardiopulmonar
 * @property string $abdomen
 * @property string $extremidades
 * @property string $sistema_nervioso
 * @property string $piel_fanera
 * @property string $otros
 * @property string $observaciones
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property DiagnosticoPrincipal $diagnosticoPrincipal
 * @property DiagnosticoRelacionado $diagnosticoRelacionado
 * @property Citas $cita
 * @property Personal $personal
 */
class HistorialExamenFisico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_examen_fisico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, peso, altura,  observaciones, fecha', 'required'),
			array('paciente_id, cita_id, personal_id, diagnostico_principal_id, diagnostico_relacionado_id', 'numerical', 'integerOnly'=>true),
			array('peso, altura, imc', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, personal_id, diagnostico_principal_id, diagnostico_relacionado_id, peso, altura, imc, cabeza_cuello, cardiopulmonar, abdomen, extremidades, sistema_nervioso, piel_fanera, otros, observaciones, fecha', 'safe', 'on'=>'search'),
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
			'diagnosticoPrincipal' => array(self::BELONGS_TO, 'DiagnosticoPrincipal', 'diagnostico_principal_id'),
			'diagnosticoRelacionado' => array(self::BELONGS_TO, 'DiagnosticoRelacionado', 'diagnostico_relacionado_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
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
			'diagnostico_principal_id' => 'Diagnostico Principal',
			'diagnostico_relacionado_id' => 'Diagnostico Relacionado',
			'peso' => 'Peso',
			'altura' => 'Altura',
			'imc' => 'Imc',
			'cabeza_cuello' => 'Cabeza y Cuello',
			'cardiopulmonar' => 'Cardiopulmonar',
			'abdomen' => 'Abdomen',
			'extremidades' => 'Extremidades',
			'sistema_nervioso' => 'Sistema Nervioso',
			'piel_fanera' => 'Piel y Fanera',
			'otros' => 'Otros',
			'observaciones' => 'Observaciones',
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
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('diagnostico_principal_id',$this->diagnostico_principal_id);
		$criteria->compare('diagnostico_relacionado_id',$this->diagnostico_relacionado_id);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('altura',$this->altura,true);
		$criteria->compare('imc',$this->imc,true);
		$criteria->compare('cabeza_cuello',$this->cabeza_cuello,true);
		$criteria->compare('cardiopulmonar',$this->cardiopulmonar,true);
		$criteria->compare('abdomen',$this->abdomen,true);
		$criteria->compare('extremidades',$this->extremidades,true);
		$criteria->compare('sistema_nervioso',$this->sistema_nervioso,true);
		$criteria->compare('piel_fanera',$this->piel_fanera,true);
		$criteria->compare('otros',$this->otros,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialExamenFisico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
