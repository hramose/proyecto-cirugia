<?php

/**
 * This is the model class for table "producto_inventario".
 *
 * The followings are the available columns in table 'producto_inventario':
 * @property integer $id
 * @property string $nombre_producto
 * @property string $producto_referencia
 * @property string $costo_iva
 * @property string $precio_publico
 * @property string $iva
 * @property integer $producto_presentacion_id
 * @property integer $cantidad
 * @property integer $producto_unidad_medida_id
 * @property integer $stock_minimo
 * @property integer $producto_proveedor_id
 * @property string $tipo_inventario
 * @property integer $producto_categoria_id
 * @property string $estado
 * @property integer $personal_id
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property ProductoPresentacion $productoPresentacion
 * @property ProductoUnidadMedida $productoUnidadMedida
 * @property ProductoProveedor $productoProveedor
 * @property ProductoCategoria $productoCategoria
 * @property Personal $personal
 */
class ProductoInventario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto_inventario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_producto, producto_referencia, precio_publico, iva, producto_presentacion_id, producto_unidad_medida_id, stock_minimo, producto_proveedor_id, tipo_inventario, producto_categoria_id, personal_id, fecha', 'required'),
			array('producto_presentacion_id, cantidad, producto_unidad_medida_id, stock_minimo, producto_proveedor_id, producto_categoria_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('nombre_producto', 'length', 'max'=>75),
			array('producto_referencia, tipo_inventario, lote', 'length', 'max'=>25),
			array('costo_iva, precio_publico, iva', 'length', 'max'=>15),
			array('estado', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_producto, producto_referencia, costo_iva, precio_publico, iva, producto_presentacion_id, cantidad, producto_unidad_medida_id, stock_minimo, producto_proveedor_id, tipo_inventario, producto_categoria_id, estado, personal_id, fecha', 'safe', 'on'=>'search'),
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
			'productoPresentacion' => array(self::BELONGS_TO, 'ProductoPresentacion', 'producto_presentacion_id'),
			'productoUnidadMedida' => array(self::BELONGS_TO, 'ProductoUnidadMedida', 'producto_unidad_medida_id'),
			'productoProveedor' => array(self::BELONGS_TO, 'ProductoProveedor', 'producto_proveedor_id'),
			'productoCategoria' => array(self::BELONGS_TO, 'ProductoCategoria', 'producto_categoria_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_producto' => 'Nombre de Producto',
			'producto_referencia' => 'Referencia',
			'costo_iva' => 'Costo con IVA',
			'precio_publico' => 'Precio al Publico',
			'iva' => 'IVA',
			'producto_presentacion_id' => 'Presentación',
			'cantidad' => 'Cantidad',
			'producto_unidad_medida_id' => 'Unidad de Medida',
			'stock_minimo' => 'Stock Minimo',
			'producto_proveedor_id' => 'Proveedor',
			'tipo_inventario' => 'Tipo de Inventario',
			'producto_categoria_id' => 'Categoria',
			'estado' => 'Estado',
			'personal_id' => 'Personal',
			'fecha' => 'Fecha',
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
		$criteria->compare('nombre_producto',$this->nombre_producto,true);
		$criteria->compare('producto_referencia',$this->producto_referencia,true);
		$criteria->compare('costo_iva',$this->costo_iva,true);
		$criteria->compare('precio_publico',$this->precio_publico,true);
		$criteria->compare('iva',$this->iva,true);
		$criteria->compare('producto_presentacion_id',$this->producto_presentacion_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('producto_unidad_medida_id',$this->producto_unidad_medida_id);
		$criteria->compare('stock_minimo',$this->stock_minimo);
		$criteria->compare('producto_proveedor_id',$this->producto_proveedor_id);
		$criteria->compare('tipo_inventario',$this->tipo_inventario,true);
		$criteria->compare('producto_categoria_id',$this->producto_categoria_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('lote',$this->lote,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	 public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->costo_iva;
                        $total += $t;
                }
                return $total;
        }

    public static function getTotal2($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->precio_publico;
                        $total += $t;
                }
                return $total;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductoInventario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
