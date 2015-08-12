<?php

/**
 * This is the model class for table "ingresos_cheques".
 *
 * The followings are the available columns in table 'ingresos_cheques':
 * @property integer $id
 * @property integer $ingresos_id
 * @property string $numero
 * @property string $entidad
 * @property string $valor
 * @property string $f_cobro
 *
 * The followings are the available model relations:
 * @property Ingresos $ingresos
 */
class IngresosCheques extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ingresos_cheques';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ingresos_id, numero, entidad, valor, f_cobro', 'required'),
			array('ingresos_id', 'numerical', 'integerOnly'=>true),
			array('numero, entidad', 'length', 'max'=>25),
			array('valor', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ingresos_id, numero, entidad, valor, f_cobro', 'safe', 'on'=>'search'),
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
			'ingresos' => array(self::BELONGS_TO, 'Ingresos', 'ingresos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ingresos_id' => 'Ingresos',
			'numero' => 'Numero',
			'entidad' => 'Entidad',
			'valor' => 'Valor',
			'f_cobro' => 'F Cobro',
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
		$criteria->compare('ingresos_id',$this->ingresos_id);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('entidad',$this->entidad,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('f_cobro',$this->f_cobro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IngresosCheques the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
