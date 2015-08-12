<?php

/**
 * This is the model class for table "orden_pedido_detalle".
 *
 * The followings are the available columns in table 'orden_pedido_detalle':
 * @property integer $id
 * @property integer $orden_pedido_id
 * @property integer $tipo_orden_pedido_id
 * @property integer $producto_id
 * @property string $area
 * @property integer $cantidad
 *
 * The followings are the available model relations:
 * @property ProductoInventario $producto
 * @property OrdenPedido $ordenPedido
 * @property TipoOrdenPedido $tipoOrdenPedido
 */
class OrdenPedidoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orden_pedido_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orden_pedido_id, tipo_orden_pedido_id, producto_id, area, cantidad', 'required'),
			array('orden_pedido_id, tipo_orden_pedido_id, producto_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('area', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orden_pedido_id, tipo_orden_pedido_id, producto_id, area, cantidad', 'safe', 'on'=>'search'),
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
			'ordenPedido' => array(self::BELONGS_TO, 'OrdenPedido', 'orden_pedido_id'),
			'tipoOrdenPedido' => array(self::BELONGS_TO, 'TipoOrdenPedido', 'tipo_orden_pedido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'orden_pedido_id' => 'Orden Pedido',
			'tipo_orden_pedido_id' => 'Tipo Orden Pedido',
			'producto_id' => 'Producto',
			'area' => 'Area',
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
		$criteria->compare('orden_pedido_id',$this->orden_pedido_id);
		$criteria->compare('tipo_orden_pedido_id',$this->tipo_orden_pedido_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('cantidad',$this->cantidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrdenPedidoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
