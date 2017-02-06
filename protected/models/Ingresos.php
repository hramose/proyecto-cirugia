<?php

/**
 * This is the model class for table "ingresos".
 *
 * The followings are the available columns in table 'ingresos':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $contrato_id
 * @property string $valor
 * @property string $descripcion
 * @property integer $centro_costo_id
 * @property integer $forma_pago
 * @property string $fecha
 * @property integer $cheques_cantidad
 * @property integer $cheques_banco_cuenta_id
 * @property string $cheques_total
 * @property string $tarjeta_tipo
 * @property string $tarjeta_aprobacion
 * @property string $tarjeta_entidad
 * @property integer $tarjeta_banco_cuenta_id
 * @property string $consigna_banco_o
 * @property string $consigna_cuenta_o
 * @property integer $consigna_banco_d_cuenta_id
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Contratos $contrato
 * @property CentroCosto $centroCosto
 * @property BancosCuentas $chequesBancoCuenta
 * @property BancosCuentas $tarjetaBancoCuenta
 * @property Bancos $consignaBancoDCuenta
 * @property Personal $personal
 */
class Ingresos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $nombre_paciente;
	public $apellido_paciente;

	public function tableName()
	{
		return 'ingresos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, contrato_id, valor, descripcion, centro_costo_id, forma_pago, fecha, cheques_cantidad, cheques_banco_cuenta_id, cheques_total, tarjeta_tipo, tarjeta_aprobacion, tarjeta_entidad, tarjeta_banco_cuenta_id, consigna_banco_o, consigna_cuenta_o, consigna_banco_d_cuenta_id, personal_id', 'required'),
			array('paciente_id, contrato_id, centro_costo_id, cheques_cantidad, cheques_banco_cuenta_id, tarjeta_banco_cuenta_id, consigna_banco_d_cuenta_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('valor, cheques_total', 'length', 'max'=>20),
			array('tarjeta_tipo', 'length', 'max'=>20),
			array('tarjeta_aprobacion, tarjeta_entidad, consigna_banco_o, consigna_cuenta_o', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, nombre_paciente, personal_seguimiento, apellido_paciente, n_identificacion, contrato_id, cita_id, vendedor_id, fecha_sola, valor, descripcion, centro_costo_id, forma_pago, fecha, cheques_cantidad, cheques_banco_cuenta_id, cheques_total, tarjeta_tipo, tarjeta_aprobacion, tarjeta_entidad, tarjeta_banco_cuenta_id, consigna_banco_o, consigna_cuenta_o, consigna_banco_d_cuenta_id, personal_id, estado', 'safe', 'on'=>'search'),
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
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'contrato_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'centroCosto' => array(self::BELONGS_TO, 'CentroCosto', 'centro_costo_id'),
			'chequesBancoCuenta' => array(self::BELONGS_TO, 'BancosCuentas', 'cheques_banco_cuenta_id'),
			'tarjetaBancoCuenta' => array(self::BELONGS_TO, 'BancosCuentas', 'tarjeta_banco_cuenta_id'),
			'consignaBancoDCuenta' => array(self::BELONGS_TO, 'Bancos', 'consigna_banco_d_cuenta_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'vendedor' => array(self::BELONGS_TO, 'Personal', 'vendedor_id'),
			'personalSeguimiento' => array(self::BELONGS_TO, 'Personal', 'personal_seguimiento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'paciente_id' => 'Paciente',
			'contrato_id' => 'Contrato',
			'valor' => 'Valor de Ingreso',
			'descripcion' => 'Descripción',
			'centro_costo_id' => 'Centro de Costo',
			'forma_pago' => 'Forma de Pago',
			'fecha' => 'Fecha y Hora',
			'cheques_cantidad' => 'Cantidad de Cheques',
			'cheques_banco_cuenta_id' => 'Cuenta de Banco',
			'cheques_total' => 'Total en Cheques',
			'tarjeta_tipo' => 'Tipo de Tarjeta',
			'tarjeta_aprobacion' => 'Aprobacion de Tarjeta',
			'tarjeta_entidad' => 'Entidad de Tarjeta',
			'tarjeta_banco_cuenta_id' => 'Cuenta de Banco',
			'consigna_banco_o' => 'Banco Origen',
			'consigna_cuenta_o' => 'Cuenta Origen',
			'consigna_banco_d_cuenta_id' => 'Cuenta de Banco Destino',
			'personal_id' => 'Personal',
			'cita_id' => 'Cita',
			'estado' => 'Estado',
			'n_identificacion' => 'Cedula',
			'fecha_sola' => 'Fecha',
			'vendedor_id' => 'Vendedor',
			'personal_seguimiento' => 'Responsable de Seguimiento',
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
		$buscar = "'Transferencia a Paciente'";
		$centro = CentroCosto::model()->find("nombre = $buscar");
		$centroid = $centro->id;

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('forma_pago',$this->forma_pago, true);
		$criteria->compare('fecha',$this->fecha,true);
		//$criteria->compare('fecha_sola',$this->fecha_sola,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria->compare('cheques_banco_cuenta_id',$this->cheques_banco_cuenta_id);
		$criteria->compare('cheques_total',$this->cheques_total,true);
		$criteria->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria->compare('t.estado',$this->estado,true);
		$criteria->compare('tarjeta_banco_cuenta_id',$this->tarjeta_banco_cuenta_id);
		$criteria->compare('consigna_banco_o',$this->consigna_banco_o,true);
		$criteria->compare('consigna_cuenta_o',$this->consigna_cuenta_o,true);
		$criteria->compare('consigna_banco_d_cuenta_id',$this->consigna_banco_d_cuenta_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('personal_seguimiento',$this->personal_seguimiento);
		$criteria->addCondition("centro_costo_id < '$centroid'");
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'fecha DESC',
			    'attributes'=>array(
			),
			),
			//'name'=>'Time',
		    //'value'=>'sprintf(\'%02s:%02s\',$data->hours,$data->minutes)',
		    //'type'=>'text',
			//'footer'=>$provider->itemCount===0 ? '' : $model->getTotal(),
		));
	}

	public function searchTransferencias()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$buscar = "'Transferencia a Paciente'";
		$centro = CentroCosto::model()->find("nombre = $buscar");
		$centroid = $centro->id;

		$criteria2=new CDbCriteria;

		$criteria2->compare('t.id',$this->id);
		$criteria2->compare('paciente_id',$this->paciente_id);
		$criteria2->compare('contrato_id',$this->contrato_id);
		$criteria2->compare('cita_id',$this->cita_id);
		$criteria2->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria2->compare('valor',$this->valor,true);
		$criteria2->compare('descripcion',$this->descripcion,true);
		$criteria2->compare('centro_costo_id',$this->centro_costo_id);
		$criteria2->compare('forma_pago',$this->forma_pago, true);
		$criteria2->compare('fecha',$this->fecha,true);
		//$criteria->compare('fecha_sola',$this->fecha_sola,true);
		$criteria2->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria2->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria2->compare('cheques_banco_cuenta_id',$this->cheques_banco_cuenta_id);
		$criteria2->compare('cheques_total',$this->cheques_total,true);
		$criteria2->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria2->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria2->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria2->compare('t.estado',$this->estado,true);
		$criteria2->compare('tarjeta_banco_cuenta_id',$this->tarjeta_banco_cuenta_id);
		$criteria2->compare('consigna_banco_o',$this->consigna_banco_o,true);
		$criteria2->compare('consigna_cuenta_o',$this->consigna_cuenta_o,true);
		$criteria2->compare('consigna_banco_d_cuenta_id',$this->consigna_banco_d_cuenta_id);
		$criteria2->compare('personal_id',$this->personal_id);
		$criteria2->compare('vendedor_id',$this->vendedor_id);
		$criteria2->compare('personal_seguimiento',$this->personal_seguimiento);
		$criteria2->addCondition("centro_costo_id = $centroid");
		$criteria2->with = array('paciente');
		$criteria2->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria2->compare('paciente.apellido', $this->apellido_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria2,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'fecha DESC',
			    'attributes'=>array(
			),
			),
			//'name'=>'Time',
		    //'value'=>'sprintf(\'%02s:%02s\',$data->hours,$data->minutes)',
		    //'type'=>'text',
			//'footer'=>$provider->itemCount===0 ? '' : $model->getTotal(),
			//'criteria'=>array('condition'=>'saldo > 0'),
		));
	}


	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$buscar = "'Transferencia a Paciente'";
		$centro = CentroCosto::model()->find("nombre = $buscar");
		$centroid = $centro->id;

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('forma_pago',$this->forma_pago, true);
		$criteria->compare('fecha',$this->fecha,true);
		//$criteria->compare('fecha_sola',$this->fecha_sola,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria->compare('cheques_banco_cuenta_id',$this->cheques_banco_cuenta_id);
		$criteria->compare('cheques_total',$this->cheques_total,true);
		$criteria->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria->compare('t.estado',$this->estado,true);
		$criteria->compare('tarjeta_banco_cuenta_id',$this->tarjeta_banco_cuenta_id);
		$criteria->compare('consigna_banco_o',$this->consigna_banco_o,true);
		$criteria->compare('consigna_cuenta_o',$this->consigna_cuenta_o,true);
		$criteria->compare('consigna_banco_d_cuenta_id',$this->consigna_banco_d_cuenta_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('personal_seguimiento',$this->personal_seguimiento);
		$criteria->addCondition("centro_costo_id != '$centroid'");
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>900000),
			//'name'=>'Time',
		    //'value'=>'sprintf(\'%02s:%02s\',$data->hours,$data->minutes)',
		    //'type'=>'text',
			//'footer'=>$provider->itemCount===0 ? '' : $model->getTotal(),
		));
	}

	public function searchSumaTransferencia()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$buscar = "'Transferencia a Paciente'";
		$centro = CentroCosto::model()->find("nombre = $buscar");
		$centroid = $centro->id;

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('centro_costo_id',$this->centro_costo_id);
		$criteria->compare('forma_pago',$this->forma_pago, true);
		$criteria->compare('fecha',$this->fecha,true);
		//$criteria->compare('fecha_sola',$this->fecha_sola,true);
		$criteria->compare('DATE_FORMAT(fecha_sola, \'%d-%m-%Y\')',$this->fecha_sola,true);
		$criteria->compare('cheques_cantidad',$this->cheques_cantidad);
		$criteria->compare('cheques_banco_cuenta_id',$this->cheques_banco_cuenta_id);
		$criteria->compare('cheques_total',$this->cheques_total,true);
		$criteria->compare('tarjeta_tipo',$this->tarjeta_tipo,true);
		$criteria->compare('tarjeta_aprobacion',$this->tarjeta_aprobacion,true);
		$criteria->compare('tarjeta_entidad',$this->tarjeta_entidad,true);
		$criteria->compare('t.estado',$this->estado,true);
		$criteria->compare('tarjeta_banco_cuenta_id',$this->tarjeta_banco_cuenta_id);
		$criteria->compare('consigna_banco_o',$this->consigna_banco_o,true);
		$criteria->compare('consigna_cuenta_o',$this->consigna_cuenta_o,true);
		$criteria->compare('consigna_banco_d_cuenta_id',$this->consigna_banco_d_cuenta_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('personal_seguimiento',$this->personal_seguimiento);
		$criteria->addCondition("centro_costo_id = $centroid");
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>900000),
			
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
                	//if ($data->estado == "Activo") {
                		$t = $data->valor;
                        $total += $t;
                    //}
                }
                return $total;
        }


        //  	public static function getTotal($provider)
        // {
        //         $total=0;
        //         foreach($provider->data as $data)
        //         {
        //                 //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
        //                 //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
        //         	if ($data->estado == "Activo") {
        //         		$t = $data->valor;
        //                 $total += $t;
        //             }
        //         }
        //         return $total;
        // }

        


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ingresos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
