<?php

/**
 * This is the model class for table "pago_cosmetologas".
 *
 * The followings are the available columns in table 'pago_cosmetologas':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $n_identificacion
 * @property integer $cita_id
 * @property integer $linea_servicio_id
 * @property integer $contrato_id
 * @property string $misma_persona
 * @property string $porcentaje
 * @property string $valor_comision
 * @property string $valor_tratamiento
 * @property string $estado
 * @property string $descarga
 * @property string $fecha
 * @property integer $vendedor_id
 * @property integer $personal_id
 * @property integer $aprobo_id
 * @property string $total_pago
 * @property string $sesion
 * @property string $fecha_pago
 *
 * The followings are the available model relations:
 * @property Citas $cita
 * @property Personal $personal
 * @property Contratos $contrato
 * @property Paciente $paciente
 * @property Personal $aprobo
 * @property LineaServicio $lineaServicio
 * @property Personal $vendedor
 */
class PagoCosmetologas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $nombre_paciente;
	public $apellido_paciente;

	public function tableName()
	{
		return 'pago_cosmetologas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, n_identificacion, cita_id, linea_servicio_id, contrato_id, misma_persona, porcentaje, valor_comision, valor_tratamiento, estado, descarga, fecha, vendedor_id, personal_id, aprobo_id, total_pago, sesion, fecha_pago', 'required'),
			
			//array('paciente_id, cita_id, linea_servicio_id, contrato_id, vendedor_id, personal_id, aprobo_id', 'numerical', 'integerOnly'=>true),
			//array('n_identificacion, estado', 'length', 'max'=>25),
			//array('misma_persona, descarga', 'length', 'max'=>2),
			//array('porcentaje, valor_comision, valor_tratamiento, total_pago', 'length', 'max'=>10),
			//array('sesion', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cita_id', 'unique'),
			array('id, paciente_id, n_identificacion, fecha_sola, valor_tratamiento_desc, nombre_paciente, apellido_paciente, saldo, cita_id, linea_servicio_id, contrato_id, misma_persona, porcentaje, valor_comision, valor_tratamiento, estado, descarga, fecha, vendedor_id, personal_id, aprobo_id, total_pago, sesion, fecha_pago', 'safe', 'on'=>'search'),
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
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'contrato_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'aprobo' => array(self::BELONGS_TO, 'Personal', 'aprobo_id'),
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
			'vendedor' => array(self::BELONGS_TO, 'Personal', 'vendedor_id'),
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
			'n_identificacion' => 'Cedula',
			'cita_id' => 'Cita',
			'linea_servicio_id' => 'Linea Servicio',
			'contrato_id' => 'Contrato',
			'misma_persona' => 'Misma Persona',
			'porcentaje' => 'Porcentaje',
			'valor_comision' => 'Valor Comision',
			'valor_tratamiento' => 'Valor Tratamiento',
			'valor_tratamiento_desc' => 'Tratamiento con Descuento',
			'estado' => 'Estado',
			'descarga' => 'Descarga',
			'fecha' => 'Fecha',
			'vendedor_id' => 'Vendedor',
			'personal_id' => 'Personal',
			'aprobo_id' => 'Aprobo',
			'total_pago' => 'Total Pago',
			'sesion' => 'Sesion',
			'fecha_pago' => 'Fecha Pago',
			'fecha_sola' => 'Fecha',
			'saldo' => 'Saldo a Favor',
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
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('misma_persona',$this->misma_persona,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('valor_comision',$this->valor_comision,true);
		$criteria->compare('valor_tratamiento',$this->valor_tratamiento,true);
		$criteria->compare('valor_tratamiento_desc',$this->valor_tratamiento_desc,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('descarga',$this->descarga,true);
		//$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('aprobo_id',$this->aprobo_id);
		$criteria->compare('total_pago',$this->total_pago,true);
		$criteria->compare('sesion',$this->sesion,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
		$criteria->compare('fecha_sola',$this->fecha_sola,true);
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
		));
	}
	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('misma_persona',$this->misma_persona,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('valor_comision',$this->valor_comision,true);
		$criteria->compare('valor_tratamiento',$this->valor_tratamiento,true);
		$criteria->compare('valor_tratamiento_desc',$this->valor_tratamiento_desc,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('descarga',$this->descarga,true);
		//$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('aprobo_id',$this->aprobo_id);
		$criteria->compare('total_pago',$this->total_pago,true);
		$criteria->compare('sesion',$this->sesion,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
		$criteria->compare('fecha_sola',$this->fecha_sola,true);

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
            		$t = $data->valor_tratamiento;
                    $total = $total + $t;
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
            		$t = $data->valor_comision;
                    $total = $total + $t;
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
            		$t = $data->contrato->saldo;
                    $total = $total + $t;
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
            		$t = $data->total_pago;
                    $total = $total + $t;
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
            		$t = $data->valor_tratamiento_desc;
                    $total = $total + $t;
            }
            return $total;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PagoCosmetologas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
