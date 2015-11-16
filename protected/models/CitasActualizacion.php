<?php

/**
 * This is the model class for table "citas_actualizacion".
 *
 * The followings are the available columns in table 'citas_actualizacion':
 * @property integer $id
 * @property string $fecha
 * @property string $personal
 * @property integer $contrato
 * @property string $servicio
 * @property string $comentario
 * @property integer $inicio
 * @property integer $fin
 * @property string $actualizacion
 * @property string $usuario
 *
 * The followings are the available model relations:
 * @property HorasServicio $inicio0
 * @property HorasServicio $fin0
 */
class CitasActualizacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'citas_actualizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, personal, servicio, comentario, inicio, fin, usuario', 'required'),
			array('cita_id, inicio, fin', 'numerical', 'integerOnly'=>true),
			array('personal, usuario', 'length', 'max'=>100),
			array('servicio', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, personal, contrato, servicio, comentario, inicio, fin, actualizacion, usuario', 'safe', 'on'=>'search'),
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
			'inicio0' => array(self::BELONGS_TO, 'HorasServicio', 'inicio'),
			'fin0' => array(self::BELONGS_TO, 'HorasServicio', 'fin'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'personal' => 'Personal',
			'contrato' => 'Contrato',
			'servicio' => 'Servicio',
			'comentario' => 'Comentario',
			'inicio' => 'Hora de Inicio',
			'fin' => 'Hora de Fin',
			'actualizacion' => 'Comentario de Actualización',
			'usuario' => 'Usuario que Actualizo',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('personal',$this->personal,true);
		$criteria->compare('contrato',$this->contrato);
		$criteria->compare('servicio',$this->servicio,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('inicio',$this->inicio);
		$criteria->compare('fin',$this->fin);
		$criteria->compare('actualizacion',$this->actualizacion,true);
		$criteria->compare('usuario',$this->usuario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CitasActualizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
