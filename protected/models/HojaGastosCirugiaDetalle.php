<?php

/**
 * This is the model class for table "hoja_gastos_cirugia_detalle".
 *
 * The followings are the available columns in table 'hoja_gastos_cirugia_detalle':
 * @property integer $id
 * @property integer $hoja_gastos_cirugia_id
 * @property integer $producto_id
 * @property integer $cantidad
 *
 * The followings are the available model relations:
 * @property ProductoInventario $producto
 * @property HojaGastosCirugia $hojaGastosCirugia
 */
class HojaGastosCirugiaDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hoja_gastos_cirugia_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hoja_gastos_cirugia_id, producto_id, cantidad', 'required'),
			array('hoja_gastos_cirugia_id, producto_id, cantidad', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hoja_gastos_cirugia_id, producto_id, cantidad', 'safe', 'on'=>'search'),
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
			'producto' => array(self::BELONGS_TO, 'ProductoInventario', 'producto_id'),
			'hojaGastosCirugia' => array(self::BELONGS_TO, 'HojaGastosCirugia', 'hoja_gastos_cirugia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hoja_gastos_cirugia_id' => 'Hoja Gastos Cirugia',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
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
		$criteria->compare('hoja_gastos_cirugia_id',$this->hoja_gastos_cirugia_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HojaGastosCirugiaDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
