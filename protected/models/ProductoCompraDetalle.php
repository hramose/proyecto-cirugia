<?php

/**
 * This is the model class for table "producto_compra_detalle".
 *
 * The followings are the available columns in table 'producto_compra_detalle':
 * @property integer $id
 * @property integer $producto_compra_id
 * @property integer $producto_id
 * @property integer $cantidad
 * @property string $valor
 * @property string $iva
 * @property string $total
 * @property string $lote
 *
 * The followings are the available model relations:
 * @property ProductoInventario $producto
 * @property ProductoCompras $productoCompra
 */
class ProductoCompraDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto_compra_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_id', 'required'),
			array('producto_compra_id, producto_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('valor, iva, total', 'length', 'max'=>15),
			array('lote', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto_compra_id, producto_id, cantidad, valor, iva, total, lote', 'safe', 'on'=>'search'),
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
			'productoCompra' => array(self::BELONGS_TO, 'ProductoCompras', 'producto_compra_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'producto_compra_id' => 'Producto Compra',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
			'valor' => 'Valor',
			'iva' => 'Iva',
			'total' => 'Total',
			'lote' => 'Lote',
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
		$criteria->compare('producto_compra_id',$this->producto_compra_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('iva',$this->iva,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('lote',$this->lote,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductoCompraDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
