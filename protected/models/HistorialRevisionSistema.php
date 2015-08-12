<?php

/**
 * This is the model class for table "historial_revision_sistema".
 *
 * The followings are the available columns in table 'historial_revision_sistema':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property integer $personal_id
 * @property string $c_c_c
 * @property string $cardio_respiratorio
 * @property string $sistema_digestivo
 * @property string $sistema_genitoUrinario
 * @property string $sistema_locomotor
 * @property string $sistema_nervioso
 * @property string $sistema_tegumentario
 * @property string $observaciones
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Personal $personal
 * @property Paciente $paciente
 * @property Citas $cita
 */
class HistorialRevisionSistema extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_revision_sistema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha', 'required'),
			array('paciente_id, cita_id, personal_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, personal_id, c_c_c, cardio_respiratorio, sistema_digestivo, sistema_genitoUrinario, sistema_locomotor, sistema_nervioso, sistema_tegumentario, observaciones, fecha', 'safe', 'on'=>'search'),
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
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
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
			'c_c_c' => 'Cabeza, Cara y Cuello',
			'cardio_respiratorio' => 'Cardio Respiratorio',
			'sistema_digestivo' => 'Sistema Digestivo',
			'sistema_genitoUrinario' => 'Sistema Genito Urinario',
			'sistema_locomotor' => 'Sistema Locomotor',
			'sistema_nervioso' => 'Sistema Nervioso',
			'sistema_tegumentario' => 'Sistema Tegumentario',
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
		$criteria->compare('c_c_c',$this->c_c_c,true);
		$criteria->compare('cardio_respiratorio',$this->cardio_respiratorio,true);
		$criteria->compare('sistema_digestivo',$this->sistema_digestivo,true);
		$criteria->compare('sistema_genitoUrinario',$this->sistema_genitoUrinario,true);
		$criteria->compare('sistema_locomotor',$this->sistema_locomotor,true);
		$criteria->compare('sistema_nervioso',$this->sistema_nervioso,true);
		$criteria->compare('sistema_tegumentario',$this->sistema_tegumentario,true);
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
	 * @return HistorialRevisionSistema the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
