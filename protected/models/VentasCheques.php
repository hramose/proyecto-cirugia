<?php

/**
 * This is the model class for table "ventas_cheques".
 *
 * The followings are the available columns in table 'ventas_cheques':
 * @property integer $id
 * @property integer $ventas_id
 * @property string $numero
 * @property string $entidad
 * @property string $valor
 * @property string $f_cobro
 *
 * The followings are the available model relations:
 * @property Ventas $ventas
 */
class VentasCheques extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ventas_cheques';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ventas_id, numero, entidad, valor, f_cobro', 'required'),
			array('ventas_id', 'numerical', 'integerOnly'=>true),
			array('numero, entidad', 'length', 'max'=>25),
			array('valor', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ventas_id, numero, entidad, valor, f_cobro', 'safe', 'on'=>'search'),
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
			'ventas' => array(self::BELONGS_TO, 'Ventas', 'ventas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ventas_id' => 'Ventas',
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
		$criteria->compare('ventas_id',$this->ventas_id);
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
	 * @return VentasCheques the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
