<?php

/**
 * This is the model class for table "citas_reservada".
 *
 * The followings are the available columns in table 'citas_reservada':
 * @property integer $id
 * @property integer $personal_id
 * @property integer $cita_id
 * @property integer $hora_inicio
 * @property integer $hora_fin
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $motivo
 * @property string $observacon
 * @property integer $usuario_id
 * @property string $fecha_creado
 *
 * The followings are the available model relations:
 * @property Personal $personal
 * @property Citas $cita
 * @property HorasServicio $horaInicio
 * @property HorasServicio $horaFin
 * @property Personal $usuario
 */
class CitasReservada extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'citas_reservada';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('personal_id, cita_id, hora_inicio, hora_fin, fecha_inicio, motivo, observacon, usuario_id, fecha_creado', 'required'),
			array('personal_id, cita_id, hora_inicio, hora_fin, usuario_id', 'numerical', 'integerOnly'=>true),
			array('fecha_fin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, personal_id, cita_id, hora_inicio, hora_fin, fecha_inicio, fecha_fin, motivo, observacon, usuario_id, fecha_creado', 'safe', 'on'=>'search'),
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
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'horaInicio' => array(self::BELONGS_TO, 'HorasServicio', 'hora_inicio'),
			'horaFin' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin'),
			'usuario' => array(self::BELONGS_TO, 'Personal', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'personal_id' => 'Personal',
			'cita_id' => 'Cita',
			'hora_inicio' => 'Hora Inicio',
			'hora_fin' => 'Hora Fin',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'motivo' => 'Motivo',
			'observacon' => 'Observacon',
			'usuario_id' => 'Usuario',
			'fecha_creado' => 'Fecha Creado',
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
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('hora_inicio',$this->hora_inicio);
		$criteria->compare('hora_fin',$this->hora_fin);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('motivo',$this->motivo,true);
		$criteria->compare('observacon',$this->observacon,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('fecha_creado',$this->fecha_creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CitasReservada the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
