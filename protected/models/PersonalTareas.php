<?php

/**
 * This is the model class for table "personal_tareas".
 *
 * The followings are the available columns in table 'personal_tareas':
 * @property integer $id
 * @property integer $personal_id
 * @property string $tarea
 * @property string $fecha_cumplir
 * @property string $estado
 * @property string $fecha
 * @property integer $usuario_id
 *
 * The followings are the available model relations:
 * @property Personal $personal
 * @property Personal $usuario
 */
class PersonalTareas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal_tareas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('personal_id, tarea, fecha_cumplir', 'required'),
			array('personal_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, personal_id, tarea, fecha_cumplir, estado, fecha, usuario_id', 'safe', 'on'=>'search'),
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
			'personal_id' => 'Personal Asignado',
			'tarea' => 'Tarea',
			'fecha_cumplir' => 'Fecha para Cumplir',
			'estado' => 'Estado',
			'fecha' => 'Fecha',
			'usuario_id' => 'Usuario que Registro',
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
		$criteria->compare('tarea',$this->tarea,true);
		$criteria->compare('fecha_cumplir',$this->fecha_cumplir,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('usuario_id',$this->usuario_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PersonalTareas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
