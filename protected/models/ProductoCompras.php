<?php

/**
 * This is the model class for table "producto_compras".
 *
 * The followings are the available columns in table 'producto_compras':
 * @property integer $id
 * @property integer $producto_proveedor_id
 * @property string $factura_n
 * @property string $forma_pago
 * @property string $descuento
 * @property integer $descuento_tipo
 * @property string $descuento_valor
 * @property string $descuento_total
 * @property string $iva
 * @property string $iva_total
 * @property string $aplica_retencion
 * @property integer $retencion_id
 * @property string $retencion_retener
 * @property string $retencion_base
 * @property string $retencion_porcentaje
 * @property string $rte_iva
 * @property string $rte_iva_valor
 * @property string $rte_ica
 * @property string $rte_ica_porcentaje
 * @property string $rte_ica_valor
 * @property integer $cantidad_productos
 * @property string $total_orden
 * @property string $total
 * @property string $total_compra
 * @property integer $centro_costo_id
 * @property integer $personal_id
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property ProductoCompraDetalle[] $productoCompraDetalles
 * @property ProductoProveedor $productoProveedor
 * @property ProductoRetenciones $retencion
 * @property CentroCosto $centroCosto
 * @property Personal $personal
 */
class ProductoCompras extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto_compras';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('producto_proveedor_id, factura_n, forma_pago, descuento, descuento_tipo, descuento_valor, descuento_total, iva, iva_total, aplica_retencion, retencion_retener, retencion_base, retencion_porcentaje, rte_iva, rte_iva_valor, rte_ica, rte_ica_porcentaje, rte_ica_valor, cantidad_productos, total_orden, total, total_compra, centro_costo_id, personal_id, fecha', 'required'),
			array('producto_proveedor_id, descuento_tipo, retencion_id, cantidad_productos, centro_costo_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('factura_n', 'length', 'max'=>25),
			array('forma_pago', 'length', 'max'=>15),
			array('descuento, aplica_retencion, rte_iva, rte_ica', 'length', 'max'=>2),
			array('descuento_valor, descuento_total, iva, iva_total, retencion_retener, retencion_base, retencion_porcentaje, rte_iva_valor, rte_ica_porcentaje, rte_ica_valor, total_orden, total, total_compra, saldo', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto_proveedor_id, nit, factura_n, fecha_sola, forma_pago, descuento, descuento_tipo, descuento_valor, descuento_total, iva, iva_total, aplica_retencion, retencion_id, retencion_retener, retencion_base, retencion_porcentaje, rte_iva, rte_iva_valor, rte_ica, rte_ica_porcentaje, rte_ica_valor, cantidad_productos, total_orden, total, total_compra, centro_costo_id, personal_id, fecha, credito_dias, credito_fecha, banco_cuenta_id, banco_destino, cuenta_destino, saldo, estado', 'safe', 'on'=>'search'),
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
			'productoCompraDetalles' => array(self::HAS_MANY, 'ProductoCompraDetalle', 'producto_compra_id'),
			'productoProveedor' => array(self::BELONGS_TO, 'ProductoProveedor', 'producto_proveedor_id'),
			'laRetencion' => array(self::BELONGS_TO, 'ProductoRetenciones', 'retencion_id'),
			'centroCosto' => array(self::BELONGS_TO, 'CentroCosto', 'centro_costo_id'),
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
			'producto_proveedor_id' => 'Proveedor',
			'nit' => 'NIT',
			'factura_n' => 'Factura N°',
			'forma_pago' => 'Forma de Pago',
			'descuento' => 'Descuento',
			'descuento_tipo' => 'Tipo',
			'descuento_valor' => 'Valor de Descuento',
			'descuento_total' => 'Total de Descuento',
			'iva' => 'IVA',
			'iva_total' => 'Total IVA',
			'aplica_retencion' => 'Aplica Retención',
			'retencion_id' => 'Retención',
			'retencion_retener' => 'Total a Retener',
			'retencion_base' => 'Retención Base',
			'retencion_porcentaje' => 'Porcentaje de Retención',
			'rte_iva' => 'Rte IVA',
			'rte_iva_valor' => 'Rte IVA Valor',
			'rte_ica' => 'Rte ICA',
			'rte_ica_porcentaje' => 'Rte ICA Porcentaje',
			'rte_ica_valor' => 'Rte Ica Valor',
			'cantidad_productos' => 'Cantidad de Productos',
			'total_orden' => 'Total de Orden',
			'total' => 'Total',
			'total_compra' => 'Total de Compra',
			'centro_costo_id' => 'Centro de Costo',
			'personal_id' => 'Personal',
			'fecha' => 'Fecha Hora',
			'fecha_sola' => 'Fecha',
			'credito_dias' => 'Dias',
			'credito_fecha' => 'Vencimiento',
			'banco_cuenta_id'=> 'Cuenta',
			'cuenta_destino'=> 'Cuenta Destino',
			'banco_destino'=> 'Banco Destino',
			'saldo'=> 'Saldo',
			'estado'=> 'Estado',
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
		$criteria->compare('producto_proveedor_id',$this->producto_proveedor_id);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('factura_n',$this->factura_n,true);
		$criteria->compare('forma_pago',$this->forma_pago,true);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('descuento_tipo',$this->descuento_tipo);
		$criteria->compare('descuento_valor',$this->descuento_valor,true);
		$criteria->compare('descuento_total',$this->descuento_total,true);
		$criteria->compare('iva',$this->iva,true);
		$criteria->compare('iva_total',$this->iva_total,true);
		$criteria->compare('aplica_retencion',$this->aplica_retencion,true);
		$criteria->compare('retencion_id',$this->retencion_id);
		$criteria->compare('retencion_retener',$this->retencion_retener,true);
		$criteria->compare('retencion_base',$this->retencion_base,true);
		$criteria->compare('retencion_porcentaje',$this->retencion_porcentaje,true);
		$criteria->compare('rte_iva',$this->rte_iva,true);
		$criteria->compare('rte_iva_valor',$this->rte_iva_valor,true);
		$criteria->compare('rte_ica',$this->rte_ica,true);
		$criteria->compare('rte_ica_porcentaje',$this->rte_ica_porcentaje,true);
		$criteria->compare('rte_ica_valor',$this->rte_ica_valor,true);
		$criteria->compare('cantidad_productos',$this->cantidad_productos);
		$criteria->compare('total_orden',$this->total_orden,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('total_compra',$this->total_compra,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('fecha',$this->fecha,true);
		//$criteria->compare('fecha_sola',$this->fecha_sola,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('credito_dias',$this->credito_dias,true);
		$criteria->compare('credito_fecha',$this->credito_fecha,true);
		$criteria->compare('banco_cuenta_id',$this->banco_cuenta_id);
		$criteria->compare('banco_destino',$this->banco_destino,true);
		$criteria->compare('cuenta_destino',$this->cuenta_destino,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('estado',$this->estado,true);

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
                		$t = $data->total_compra;
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
                		$t = $data->saldo;
                        $total += $t;
                }
                return $total;
        }

       

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductoCompras the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
