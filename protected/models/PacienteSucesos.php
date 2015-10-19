<?php

/**
 * This is the model class for table "paciente_sucesos".
 *
 * The followings are the available columns in table 'paciente_sucesos':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $suceso
 * @property string $fecha
 * @property integer $hora
 * @property integer $usuario_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property HorasServicio $hora0
 * @property Usuarios $usuario
 */
class PacienteSucesos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente_sucesos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, suceso, fecha, usuario_id', 'required'),
			array('paciente_id, hora, usuario_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, suceso, fecha, hora, usuario_id', 'safe', 'on'=>'search'),
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
			'hora0' => array(self::BELONGS_TO, 'HorasServicio', 'hora'),
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'usuario_id'),
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
			'suceso' => 'Suceso',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'usuario_id' => 'Usuario',
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
		$criteria->compare('suceso',$this->suceso,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora);
		$criteria->compare('usuario_id',$this->usuario_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PacienteSucesos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
