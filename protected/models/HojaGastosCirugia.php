<?php

/**
 * This is the model class for table "hoja_gastos_cirugia".
 *
 * The followings are the available columns in table 'hoja_gastos_cirugia':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $cita_id
 * @property string $fecha_cirugia
 * @property integer $sala
 * @property string $peso
 * @property string $tipo_paciente
 * @property string $tipo_anestesia
 * @property string $tipo_cirugia
 * @property string $cirugia
 * @property string $cirugia_codigo
 * @property string $hora_ingreso
 * @property string $hora_inicio_cirugia
 * @property string $hora_final_cirugia
 * @property integer $cirujano_id
 * @property integer $ayudante_id
 * @property integer $anestesiologo_id
 * @property integer $rotadora_id
 * @property integer $instrumentadora_id
 * @property integer $cantidad_productos
 * @property string $fecha
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Personal $cirujano
 * @property Citas $cita
 * @property Personal $ayudante
 * @property Personal $anestesiologo
 * @property Personal $rotadora
 * @property Personal $instrumentadora
 * @property Personal $personal
 * @property HojaGastosCirugiaDetalle[] $hojaGastosCirugiaDetalles
 */
class HojaGastosCirugia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hoja_gastos_cirugia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, cita_id, fecha_cirugia, sala, peso, tipo_paciente, tipo_anestesia, tipo_cirugia, cirugia, cirugia_codigo, hora_ingreso, hora_inicio_cirugia, hora_final_cirugia, cirujano_id, ayudante_id, anestesiologo_id, rotadora_id, instrumentadora_id, cantidad_productos, fecha, personal_id', 'required'),
			array('paciente_id, cita_id, sala, cirujano_id, ayudante_id, anestesiologo_id, rotadora_id, instrumentadora_id, cantidad_productos, personal_id', 'numerical', 'integerOnly'=>true),
			array('peso', 'length', 'max'=>10),
			array('tipo_paciente, tipo_anestesia, tipo_cirugia, cirugia_codigo', 'length', 'max'=>20),
			array('cirugia', 'length', 'max'=>150),
			array('hora_ingreso, hora_inicio_cirugia, hora_final_cirugia', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, cita_id, fecha_cirugia, sala, peso, tipo_paciente, tipo_anestesia, tipo_cirugia, cirugia, cirugia_codigo, hora_ingreso, hora_inicio_cirugia, hora_final_cirugia, cirujano_id, ayudante_id, anestesiologo_id, rotadora_id, instrumentadora_id, cantidad_productos, fecha, personal_id', 'safe', 'on'=>'search'),
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
			'cirujano' => array(self::BELONGS_TO, 'Personal', 'cirujano_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'ayudante' => array(self::BELONGS_TO, 'Personal', 'ayudante_id'),
			'anestesiologo' => array(self::BELONGS_TO, 'Personal', 'anestesiologo_id'),
			'rotadora' => array(self::BELONGS_TO, 'Personal', 'rotadora_id'),
			'instrumentadora' => array(self::BELONGS_TO, 'Personal', 'instrumentadora_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'hojaGastosCirugiaDetalles' => array(self::HAS_MANY, 'HojaGastosCirugiaDetalle', 'hoja_gastos_cirugia_id'),
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
			'fecha_cirugia' => 'Fecha de Cirugia',
			'sala' => 'Sala',
			'peso' => 'Peso',
			'tipo_paciente' => 'Tipo de Paciente',
			'tipo_anestesia' => 'Tipo de Anestesia',
			'tipo_cirugia' => 'Tipo de Cirugia',
			'cirugia' => 'Cirugia',
			'cirugia_codigo' => 'Código de Cirugia',
			'hora_ingreso' => 'Hora de Ingreso',
			'hora_inicio_cirugia' => 'Hora de Inicio de Cirugia',
			'hora_final_cirugia' => 'Hora de Final de Cirugia',
			'cirujano_id' => 'Cirujano',
			'ayudante_id' => 'Ayudante',
			'anestesiologo_id' => 'Anestesiologo',
			'rotadora_id' => 'Rotadora',
			'instrumentadora_id' => 'Instrumentadora',
			'cantidad_productos' => 'Cantidad de Productos',
			'fecha' => 'Fecha',
			'personal_id' => 'Personal',
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
		$criteria->compare('fecha_cirugia',$this->fecha_cirugia,true);
		$criteria->compare('sala',$this->sala);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('tipo_paciente',$this->tipo_paciente,true);
		$criteria->compare('tipo_anestesia',$this->tipo_anestesia,true);
		$criteria->compare('tipo_cirugia',$this->tipo_cirugia,true);
		$criteria->compare('cirugia',$this->cirugia,true);
		$criteria->compare('cirugia_codigo',$this->cirugia_codigo,true);
		$criteria->compare('hora_ingreso',$this->hora_ingreso,true);
		$criteria->compare('hora_inicio_cirugia',$this->hora_inicio_cirugia,true);
		$criteria->compare('hora_final_cirugia',$this->hora_final_cirugia,true);
		$criteria->compare('cirujano_id',$this->cirujano_id);
		$criteria->compare('ayudante_id',$this->ayudante_id);
		$criteria->compare('anestesiologo_id',$this->anestesiologo_id);
		$criteria->compare('rotadora_id',$this->rotadora_id);
		$criteria->compare('instrumentadora_id',$this->instrumentadora_id);
		$criteria->compare('cantidad_productos',$this->cantidad_productos);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HojaGastosCirugia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
