<?php

/**
 * This is the model class for table "producto_inventario_detalle".
 *
 * The followings are the available columns in table 'producto_inventario_detalle':
 * @property integer $id
 * @property integer $producto_inventario_id
 * @property string $lote
 * @property integer $cantidad_compra
 * @property integer $existencia
 *
 * The followings are the available model relations:
 * @property ProductoInventario $productoInventario
 */
class ProductoInventarioDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto_inventario_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_inventario_id', 'required'),
			array('producto_inventario_id, cantidad_compra, existencia', 'numerical', 'integerOnly'=>true),
			array('lote', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto_inventario_id, lote, cantidad_compra, existencia', 'safe', 'on'=>'search'),
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
			'productoInventario' => array(self::BELONGS_TO, 'ProductoInventario', 'producto_inventario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'producto_inventario_id' => 'Producto Inventario',
			'lote' => 'Lote',
			'cantidad_compra' => 'Cantidad Compra',
			'existencia' => 'Existencia',
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
		$criteria->compare('producto_inventario_id',$this->producto_inventario_id);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('cantidad_compra',$this->cantidad_compra);
		$criteria->compare('existencia',$this->existencia);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductoInventarioDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
