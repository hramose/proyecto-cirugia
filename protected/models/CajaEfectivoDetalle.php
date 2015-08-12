<?php

/**
 * This is the model class for table "caja_efectivo_detalle".
 *
 * The followings are the available columns in table 'caja_efectivo_detalle':
 * @property integer $id
 * @property integer $caja_efectivo_id
 * @property string $monto
 * @property string $tipo
 * @property integer $ingreso_id
 * @property integer $egreso_id
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property CajaEfectivo $cajaEfectivo
 * @property Ingresos $ingreso
 * @property Egresos $egreso
 */
class CajaEfectivoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'caja_efectivo_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caja_efectivo_id, monto, tipo, fecha', 'required'),
			array('caja_efectivo_id, ingreso_id, egreso_id, venta_id', 'numerical', 'integerOnly'=>true),
			array('monto', 'length', 'max'=>20),
			array('tipo', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, caja_efectivo_id, monto, tipo, ingreso_id, egreso_id, fecha', 'safe', 'on'=>'search'),
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
			'cajaEfectivo' => array(self::BELONGS_TO, 'CajaEfectivo', 'caja_efectivo_id'),
			'ingreso' => array(self::BELONGS_TO, 'Ingresos', 'ingreso_id'),
			'egreso' => array(self::BELONGS_TO, 'Egresos', 'egreso_id'),
			'venta' => array(self::BELONGS_TO, 'Ventas', 'venta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'caja_efectivo_id' => 'Caja Efectivo',
			'monto' => 'Monto',
			'tipo' => 'Tipo',
			'ingreso_id' => 'Ingreso',
			'egreso_id' => 'Egreso',
			'venta_id' => 'Venta',
			'fecha' => 'Fecha',
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
		$criteria->compare('caja_efectivo_id',$this->caja_efectivo_id);
		$criteria->compare('monto',$this->monto,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('ingreso_id',$this->ingreso_id);
		$criteria->compare('egreso_id',$this->egreso_id);
		$criteria->compare('venta_id',$this->venta_id);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaEfectivoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
