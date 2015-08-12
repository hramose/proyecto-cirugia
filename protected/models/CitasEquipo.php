<?php

/**
 * This is the model class for table "citas_equipo".
 *
 * The followings are the available columns in table 'citas_equipo':
 * @property integer $cita_id
 * @property string $fecha
 * @property integer $hora_inicio
 * @property integer $hora_fin
 * @property integer $equipo_id
 * @property integer $linea_servicio_id
 *
 * The followings are the available model relations:
 * @property LineaServicio $lineaServicio
 * @property HorasServicio $horaInicio
 * @property HorasServicio $horaFin
 * @property Equipos $equipo
 * @property Citas $cita
 */
class CitasEquipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'citas_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cita_id, fecha, hora_inicio, hora_fin, equipo_id, linea_servicio_id', 'required'),
			array('cita_id, hora_inicio, hora_fin, equipo_id, linea_servicio_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cita_id, fecha, hora_inicio, hora_fin, equipo_id, linea_servicio_id, hora_fin_mostrar', 'safe', 'on'=>'search'),
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
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
			'horaInicio' => array(self::BELONGS_TO, 'HorasServicio', 'hora_inicio'),
			'horaFin' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin'),
			'horaFinMostrar' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin_mostrar'),
			'equipo' => array(self::BELONGS_TO, 'Equipos', 'equipo_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cita_id' => 'Cita',
			'fecha' => 'Fecha',
			'hora_inicio' => 'Hora Inicio',
			'hora_fin' => 'Hora Fin',
			'hora_fin_mostrar' => 'Hora Fin',
			'equipo_id' => 'Equipo',
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

		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('hora_inicio',$this->hora_inicio);
		$criteria->compare('hora_fin',$this->hora_fin);
		$criteria->compare('hora_fin_mostrar',$this->hora_fin_mostrar);
		$criteria->compare('equipo_id',$this->equipo_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CitasEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
