<?php

/**
 * This is the model class for table "egresos".
 *
 * The followings are the available columns in table 'egresos':
 * @property integer $id
 * @property integer $proveedor_id
 * @property integer $factura_id
 * @property string $forma_pago
 * @property string $desc_pronto_pago
 * @property string $desc_pronto_pago_tipo
 * @property string $desc_pronto_pago_valor
 * @property string $iva_porcentace
 * @property string $valor_egreso
 * @property string $total_descuento
 * @property string $iva_valor
 * @property string $rte_aplica
 * @property integer $retencion_id
 * @property string $a_retener
 * @property string $rte_base
 * @property string $rte_porcenaje
 * @property string $rte_iva
 * @property string $rte_iva_valor
 * @property string $rte_ica
 * @property string $rte_ica_porcentaje
 * @property string $rte_ica_valor
 * @property string $rte_cree
 * @property string $rte_cree_porcentaje
 * @property string $rte_cree_valor
 * @property integer $centro_costo_id
 * @property string $total_egreso
 *
 * The followings are the available model relations:
 * @property CajaEfectivoDetalle[] $cajaEfectivoDetalles
 * @property ProductoProveedor $proveedor
 * @property ProductoCompras $factura
 * @property ProductoRetenciones $retencion
 * @property CentroCosto $centroCosto
 */
class Egresos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'egresos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('proveedor_id, factura_id, forma_pago, desc_pronto_pago, desc_pronto_pago_tipo, desc_pronto_pago_valor, iva_porcentace, valor_egreso, total_descuento, iva_valor, rte_aplica, retencion_id, a_retener, rte_base, rte_porcenaje, rte_iva, rte_iva_valor, rte_ica, rte_ica_porcentaje, rte_ica_valor, rte_cree, rte_cree_porcentaje, rte_cree_valor, centro_costo_id, total_egreso', 'required'),
			array('proveedor_id, factura_id, retencion_id, centro_costo_id, banco_cuenta_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('forma_pago', 'length', 'max'=>15),
			array('desc_pronto_pago, rte_aplica, rte_iva, rte_ica, rte_cree', 'length', 'max'=>2),
			array('desc_pronto_pago_tipo', 'length', 'max'=>1),
			array('banco_destino, cuenta_destino', 'length', 'max'=>25),
			array('desc_pronto_pago_valor, iva_porcentace, valor_egreso, total_descuento, iva_valor, a_retener, rte_base, rte_porcenaje, rte_iva_porcentaje, rte_iva_valor, rte_ica_porcentaje, rte_ica_valor, rte_cree_porcentaje, rte_cree_valor, total_egreso', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, proveedor_id, observaciones, aplica_factura, n_identificacion, factura_id, fecha_sola, forma_pago, desc_pronto_pago, desc_pronto_pago_tipo, desc_pronto_pago_valor, iva_porcentace, valor_egreso, total_descuento, iva_valor, rte_aplica, retencion_id, a_retener, rte_base, rte_porcenaje, rte_iva, rte_iva_valor, rte_ica, rte_ica_porcentaje, rte_ica_valor, rte_cree, rte_cree_porcentaje, rte_cree_valor, centro_costo_id, total_egreso, fecha, estado', 'safe', 'on'=>'search'),
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
			'cajaEfectivoDetalles' => array(self::HAS_MANY, 'CajaEfectivoDetalle', 'egreso_id'),
			'proveedor' => array(self::BELONGS_TO, 'ProductoProveedor', 'proveedor_id'),
			'factura' => array(self::BELONGS_TO, 'ProductoCompras', 'factura_id'),
			'retencion' => array(self::BELONGS_TO, 'ProductoRetenciones', 'retencion_id'),
			'centroCosto' => array(self::BELONGS_TO, 'CentroCosto', 'centro_costo_id'),
			'consignaBancoCuenta' => array(self::BELONGS_TO, 'BancosCuentas', 'banco_cuenta_id'),
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
			'proveedor_id' => 'Proveedor (NIT/C.C)',
			'n_identificacion' => 'NIT/C.C',
			'observaciones' => 'Observaciones',
			'aplica_factura' => 'Aplica Factura',
			'factura_id' => 'Factura',
			'forma_pago' => 'Forma de Pago',
			'desc_pronto_pago' => 'Desc. por Pronto Pago',
			'desc_pronto_pago_tipo' => 'Tipo de Desc.',
			'desc_pronto_pago_valor' => 'Valor de Desc.',
			'iva_porcentace' => 'Porcentaje de IVA',
			'valor_egreso' => 'Valor Egreso',
			'total_descuento' => 'Total Descuento',
			'iva_valor' => 'IVA Valor',
			'rte_aplica' => 'Rte. Aplica',
			'retencion_id' => 'Retencion',
			'a_retener' => 'A Retener',
			'rte_base' => 'Rte. Base',
			'rte_porcenaje' => 'Rte. Porcenaje',
			'rte_iva' => 'Rte. Iva',
			'rte_iva_porcentaje' => 'Rte. Iva Porcentaje',
			'rte_iva_valor' => 'Rte. Iva Valor',
			'rte_ica' => 'Rte. Ica',
			'rte_ica_porcentaje' => 'Rte. Ica Porcentaje',
			'rte_ica_valor' => 'Rte. Ica Valor',
			'rte_cree' => 'Rte. Cree',
			'rte_cree_porcentaje' => 'Rte. Cree Porcentaje',
			'rte_cree_valor' => 'Rte. Cree Valor',
			'centro_costo_id' => 'Centro de Costo',
			'total_egreso' => 'Total de Egreso',
			'banco_cuenta_id' => 'Cuenta de Origen',
			'banco_destino' => 'Banco de Destino',
			'cuenta_destino' => 'Cuenta de Destino',
			'estado' => 'Estado',
			'fecha' => 'Fecha y Hora',
			'personal_id' => 'Personal',
			'fecha_sola' => 'Fecha',
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('proveedor_id',$this->proveedor_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('aplica_factura',$this->aplica_factura,true);
		$criteria->compare('factura_id',$this->factura_id);
		$criteria->compare('forma_pago',$this->forma_pago,true);
		$criteria->compare('desc_pronto_pago',$this->desc_pronto_pago,true);
		$criteria->compare('desc_pronto_pago_tipo',$this->desc_pronto_pago_tipo,true);
		$criteria->compare('desc_pronto_pago_valor',$this->desc_pronto_pago_valor,true);
		$criteria->compare('iva_porcentace',$this->iva_porcentace,true);
		$criteria->compare('valor_egreso',$this->valor_egreso,true);
		$criteria->compare('total_descuento',$this->total_descuento,true);
		$criteria->compare('iva_valor',$this->iva_valor,true);
		$criteria->compare('rte_aplica',$this->rte_aplica,true);
		$criteria->compare('retencion_id',$this->retencion_id);
		$criteria->compare('a_retener',$this->a_retener,true);
		$criteria->compare('rte_base',$this->rte_base,true);
		$criteria->compare('rte_porcenaje',$this->rte_porcenaje,true);
		$criteria->compare('rte_iva',$this->rte_iva,true);
		$criteria->compare('rte_iva_porcentaje',$this->rte_iva_porcentaje,true);
		$criteria->compare('rte_iva_valor',$this->rte_iva_valor,true);
		$criteria->compare('rte_ica',$this->rte_ica,true);
		$criteria->compare('rte_ica_porcentaje',$this->rte_ica_porcentaje,true);
		$criteria->compare('rte_ica_valor',$this->rte_ica_valor,true);
		$criteria->compare('rte_cree',$this->rte_cree,true);
		$criteria->compare('rte_cree_porcentaje',$this->rte_cree_porcentaje,true);
		$criteria->compare('rte_cree_valor',$this->rte_cree_valor,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('total_egreso',$this->total_egreso,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'id DESC',
			    'attributes'=>array(
			),
			),
		));
	}

	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('proveedor_id',$this->proveedor_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('aplica_factura',$this->aplica_factura,true);
		$criteria->compare('factura_id',$this->factura_id);
		$criteria->compare('forma_pago',$this->forma_pago,true);
		$criteria->compare('desc_pronto_pago',$this->desc_pronto_pago,true);
		$criteria->compare('desc_pronto_pago_tipo',$this->desc_pronto_pago_tipo,true);
		$criteria->compare('desc_pronto_pago_valor',$this->desc_pronto_pago_valor,true);
		$criteria->compare('iva_porcentace',$this->iva_porcentace,true);
		$criteria->compare('valor_egreso',$this->valor_egreso,true);
		$criteria->compare('total_descuento',$this->total_descuento,true);
		$criteria->compare('iva_valor',$this->iva_valor,true);
		$criteria->compare('rte_aplica',$this->rte_aplica,true);
		$criteria->compare('retencion_id',$this->retencion_id);
		$criteria->compare('a_retener',$this->a_retener,true);
		$criteria->compare('rte_base',$this->rte_base,true);
		$criteria->compare('rte_porcenaje',$this->rte_porcenaje,true);
		$criteria->compare('rte_iva',$this->rte_iva,true);
		$criteria->compare('rte_iva_porcentaje',$this->rte_iva_porcentaje,true);
		$criteria->compare('rte_iva_valor',$this->rte_iva_valor,true);
		$criteria->compare('rte_ica',$this->rte_ica,true);
		$criteria->compare('rte_ica_porcentaje',$this->rte_ica_porcentaje,true);
		$criteria->compare('rte_ica_valor',$this->rte_ica_valor,true);
		$criteria->compare('rte_cree',$this->rte_cree,true);
		$criteria->compare('rte_cree_porcentaje',$this->rte_cree_porcentaje,true);
		$criteria->compare('rte_cree_valor',$this->rte_cree_valor,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('total_egreso',$this->total_egreso,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>9000000),
		));
	}

		public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->total_egreso;
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
                		$t = $data->iva_valor;
                        $total += $t;
                }
                return $total;
        }

        public static function getTotal3($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->valor_egreso;
                        $total += $t;
                }
                return $total;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Egresos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
