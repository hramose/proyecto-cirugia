<?php

/**
 * This is the model class for table "ventas".
 *
 * The followings are the available columns in table 'ventas':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $descripcion
 * @property string $sub_total
 * @property string $total_iva
 * @property string $descuento
 * @property string $descuento_tipo
 * @property string $descuento_valor
 * @property string $descuento_total
 * @property integer $cant_productos
 * @property string $total_orden
 * @property string $forma_pago
 * @property string $dinero_recibido
 * @property string $dinero_cambio
 * @property string $total_venta
 * @property integer $credito_dias
 * @property string $credito_fecha
 * @property integer $cheques_cantidad
 * @property integer $cheques_cuenta_banco
 * @property string $tarjeta_tipo
 * @property string $tarjeta_aprobacion
 * @property string $tarjeta_entidad
 * @property integer $tarjeta_cuenta_banco
 * @property integer $consignacion_cuenta_banco
 * @property string $consignacion_banco
 * @property string $consignacion_cuenta
 * @property integer $personal
 * @property string $fecha_hora
 * @property string $fecha
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property BancosCuentas $chequesCuentaBanco
 * @property BancosCuentas $tarjetaCuentaBanco
 * @property Personal $personal0
 * @property BancosCuentas $consignacionCuentaBanco
 * @property VentasCheques[] $ventasCheques
 */
class Ventas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ventas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, descripcion, sub_total, total_iva, descuento, descuento_tipo, descuento_valor, descuento_total, cant_productos, total_orden, forma_pago, dinero_recibido, dinero_cambio, total_venta, credito_dias, credito_fecha, cheques_cantidad, cheques_cuenta_banco, tarjeta_tipo, tarjeta_aprobacion, tarjeta_entidad, tarjeta_cuenta_banco, consignacion_cuenta_banco, consignacion_banco, consignacion_cuenta, personal, fecha_hora, fecha, estado', 'required'),
			array('paciente_id, cant_productos, credito_dias, cheques_cantidad, cheques_total, cheques_cuenta_banco, tarjeta_cuenta_banco, consignacion_cuenta_banco, personal', 'numerical', 'integerOnly'=>true),
			array('sub_total, total_iva, descuento_valor, descuento_total, total_orden, dinero_recibido, dinero_cambio, total_venta', 'length', 'max'=>20),
			array('descuento', 'length', 'max'=>2),
			array('descuento_tipo', 'length', 'max'=>1),
			array('forma_pago, tarjeta_tipo, tarjeta_aprobacion, tarjeta_entidad, consignacion_banco, consignacion_cuenta', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, descripcion, sub_total, total_iva, vendedor_id, n_identificacion, descuento, descuento_tipo, descuento_valor, descuento_total, cant_productos, total_orden, forma_pago, dinero_recibido, dinero_cambio, total_venta, credito_dias, credito_fecha, cheques_cantidad, cheques_cuenta_banco, tarjeta_tipo, tarjeta_aprobacion, tarjeta_entidad, tarjeta_cuenta_banco, consignacion_cuenta_banco, consignacion_banco, consignacion_cuenta, personal, fecha_hora, fecha, estado', 'safe', 'on'=>'search'),
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
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'vendedor' => array(self::BELONGS_TO, 'Personal', 'vendedor_id'),
			'chequesCuentaBanco' => array(self::BELONGS_TO, 'BancosCuentas', 'cheques_cuenta_banco'),
			'tarjetaCuentaBanco' => array(self::BELONGS_TO, 'BancosCuentas', 'tarjeta_cuenta_banco'),
			'personal0' => array(self::BELONGS_TO, 'Personal', 'personal'),
			'consignacionCuentaBanco' => array(self::BELONGS_TO, 'BancosCuentas', 'consignacion_cuenta_banco'),
			'ventasCheques' => array(self::HAS_MANY, 'VentasCheques', 'ventas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'paciente_id' => 'C.C',
			'descripcion' => 'Descripción',
			'sub_total' => 'Sub Total',
			'total_iva' => 'Total Iva',
			'descuento' => 'Descuento',
			'descuento_tipo' => 'Descuento Tipo',
			'descuento_valor' => 'Descuento Valor',
			'descuento_total' => 'Descuento Total',
			'cant_productos' => 'Cant Productos',
			'total_orden' => 'Total Orden',
			'forma_pago' => 'Forma Pago',
			'dinero_recibido' => 'Dinero Recibido',
			'dinero_cambio' => 'Dinero Cambio',
			'total_venta' => 'Total Venta',
			'credito_dias' => 'Credito Dias',
			'credito_fecha' => 'Credito Fecha',
			'cheques_cantidad' => 'Cheques Cantidad',
			'cheques_total' => 'Cheques Total',
			'cheques_cuenta_banco' => 'Cheques Cuenta Banco',
			'tarjeta_tipo' => 'Tarjeta Tipo',
			'tarjeta_aprobacion' => 'Tarjeta Aprobacion',
			'tarjeta_entidad' => 'Tarjeta Entidad',
			'tarjeta_cuenta_banco' => 'Tarjeta Cuenta Banco',
			'consignacion_cuenta_banco' => 'Consignacion Cuenta Banco',
			'consignacion_banco' => 'Consignacion Banco',
			'consignacion_cuenta' => 'Consignacion Cuenta',
			'personal' => 'Personal',
			'fecha_hora' => 'Fecha Hora',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
			'n_identificacion' => 'Cedula',
			'vendedor_id' => 'Vendedor',
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
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('sub_total',$this->sub_total,true);
		$criteria->compare('total_iva',$this->total_iva,true);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('descuento_tipo',$this->descuento_tipo,true);
		$criteria->compare('descuento_valor',$this->descuento_valor,true);
		$criteria->compare('descuento_total',$this->descuento_total,true);
		$criteria->compare('cant_productos',$this->cant_productos);
		$criteria->compare('total_orden',$this->total_orden,true);
		$criteria->compare('forma_pago',$this->forma_pago,true);
		$criteria->compare('dinero_recibido',$this->dinero_recibido,true);
		$criteria->compare('dinero_cambio',$this->dinero_cambio,true);
		$criteria->compare('total_venta',$this->total_venta,true);
		$criteria->compare('credito_dias',$this->credito_dias);
		$criteria->compare('credito_fecha',$this->credito_fecha,true);
		$criteria->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria->compare('cheques_total',$this->cheques_total);
		$criteria->compare('cheques_cuenta_banco',$this->cheques_cuenta_banco);
		$criteria->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria->compare('tarjeta_cuenta_banco',$this->tarjeta_cuenta_banco);
		$criteria->compare('consignacion_cuenta_banco',$this->consignacion_cuenta_banco);
		$criteria->compare('consignacion_banco',$this->consignacion_banco,true);
		$criteria->compare('consignacion_cuenta',$this->consignacion_cuenta,true);
		$criteria->compare('personal',$this->personal);
		$criteria->compare('fecha_hora',$this->fecha_hora,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'fecha_hora DESC',
			    'attributes'=>array(
			),
			),

		));
	}

	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('sub_total',$this->sub_total,true);
		$criteria->compare('total_iva',$this->total_iva,true);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('descuento_tipo',$this->descuento_tipo,true);
		$criteria->compare('descuento_valor',$this->descuento_valor,true);
		$criteria->compare('descuento_total',$this->descuento_total,true);
		$criteria->compare('cant_productos',$this->cant_productos);
		$criteria->compare('total_orden',$this->total_orden,true);
		$criteria->compare('forma_pago',$this->forma_pago,true);
		$criteria->compare('dinero_recibido',$this->dinero_recibido,true);
		$criteria->compare('dinero_cambio',$this->dinero_cambio,true);
		$criteria->compare('total_venta',$this->total_venta,true);
		$criteria->compare('credito_dias',$this->credito_dias);
		$criteria->compare('credito_fecha',$this->credito_fecha,true);
		$criteria->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria->compare('cheques_total',$this->cheques_total);
		$criteria->compare('cheques_cuenta_banco',$this->cheques_cuenta_banco);
		$criteria->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria->compare('tarjeta_cuenta_banco',$this->tarjeta_cuenta_banco);
		$criteria->compare('consignacion_cuenta_banco',$this->consignacion_cuenta_banco);
		$criteria->compare('consignacion_banco',$this->consignacion_banco,true);
		$criteria->compare('consignacion_cuenta',$this->consignacion_cuenta,true);
		$criteria->compare('personal',$this->personal);
		$criteria->compare('fecha_hora',$this->fecha_hora,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>9000000),
			
			//'name'=>'Time',
		    //'value'=>'sprintf(\'%02s:%02s\',$data->hours,$data->minutes)',
		    //'type'=>'text',
			//'footer'=>$provider->itemCount===0 ? '' : $model->getTotal(),
		));
	}

		public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->total_venta;
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
                		$t = $data->descuento_total;
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
                		$t = $data->descuento_valor;
                        $total += $t;
                }
                return $total;
        }

        public static function getTotal4($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->total_iva;
                        $total += $t;
                }
                return $total;
        }

        public static function getTotal5($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->sub_total;
                        $total += $t;
                }
                return $total;
        }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ventas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
