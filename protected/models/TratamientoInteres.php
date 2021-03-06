<?php

/**
 * This is the model class for table "tratamiento_interes".
 *
 * The followings are the available columns in table 'tratamiento_interes':
 * @property integer $id
 * @property string $name
 * @property string $estado
 * @property string $mostrar
 *
 * The followings are the available model relations:
 * @property Paciente[] $pacientes
 */
class TratamientoInteres extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tratamiento_interes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado, mostrar', 'required'),
			array('name', 'length', 'max'=>254),
			array('estado', 'length', 'max'=>10),
			array('mostrar', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, estado, mostrar', 'safe', 'on'=>'search'),
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
			//'pacientes' => array(self::HAS_MANY, 'Paciente', 'tratamiento_interes_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Nombre',
			'estado' => 'Estado',
			'mostrar' => 'Mostrar',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('mostrar',$this->mostrar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TratamientoInteres the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
