<?php

/**
 * This is the model class for table "contratos".
 *
 * The followings are the available columns in table 'contratos':
 * @property integer $id
 * @property integer $presupuesto_id
 * @property integer $paciente_id
 * @property string $estado
 * @property string $fecha
 * @property string $total
 * @property integer $usuario_id
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property ContratoDetalle[] $contratoDetalles
 * @property Presupuesto $presupuesto
 * @property Paciente $paciente
 * @property Personal $usuario
 */
class Contratos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $nombre_paciente;
	public $apellido_paciente;
	public $n_identificacion;

	public function tableName()
	{
		return 'contratos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('presupuesto_id, paciente_id, estado, fecha, total, usuario_id, observaciones', 'required'),
			//array('observaciones', 'required'),
			array('presupuesto_id, paciente_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>25),
			array('total, saldo, descuento_liquidacion, porcentaje_descuento_liquidacion', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, presupuesto_id, paciente_id, estado, comentario_liquidado, fecha_sola, descuento, saldo_favor, nombre_paciente, n_identificacion, apellido_paciente, vendedor_id, fecha, fechahora, n_identificacion, total, usuario_id, observaciones, observaciones_liquidacion, usuario_completo, fecha_completo', 'safe', 'on'=>'search'),
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
			'contratoDetalles' => array(self::HAS_MANY, 'ContratoDetalle', 'contrato_id'),
			'presupuesto' => array(self::BELONGS_TO, 'Presupuesto', 'presupuesto_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'usuario' => array(self::BELONGS_TO, 'Personal', 'usuario_id'),
			'usuarioCompleto' => array(self::BELONGS_TO, 'Personal', 'usuario_completo'),
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
			'presupuesto_id' => 'Presupuesto',
			'paciente_id' => 'Paciente',
			'estado' => 'Estado',
			'fecha' => 'Fecha',
			'fecha_sola' => 'Fecha',
			'total' => 'Total',
			'saldo' => 'Saldo',
			'usuario_id' => 'Usuario',
			'vendedor_id' => 'Vendedor',
			'n_identificacion' => 'Cedula',
			'observaciones' => 'Observaciones',
			'fechahora' => 'fechahora',
			'descuento' => 'descuento',
			'saldo_favor' => 'Saldo a Favor',
			'descuento_liquidacion' => 'Desc. por Liquidación ($)',
			'porcentaje_descuento_liquidacion' => 'Desc. por Liquidación (%)',
			'observaciones_liquidacion' => 'Observaciones de Liquidación',
			'usuario_completo' => 'Usuario que Completo Contrato',
			'fecha_completo' => 'Fecha en la que se Completo',
			'comentario_liquidado' => 'Comentario de Liquidación',
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
		$criteria->compare('presupuesto_id',$this->presupuesto_id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('t.estado',$this->estado,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('fechahora',$this->fechahora,true);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('saldo_favor',$this->saldo_favor,true);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('observaciones_liquidacion',$this->observaciones_liquidacion,true);
		$criteria->compare('descuento_liquidacion',$this->descuento_liquidacion,true);
		$criteria->compare('porcentaje_descuento_liquidacion',$this->porcentaje_descuento_liquidacion,true);
		$criteria->with = array('paciente');
		$criteria->compare('paciente.n_identificacion', $this->n_identificacion, true );
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'t.id DESC',
			    'attributes'=>array(
			    	'desc'=>'t.id desc',
			),
			),
		));
	}
	
	public static function getTotal($provider)
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

        public static function getTotal2($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		
	                		$t = $data->total;
	                        $total += $t;
                		
                		
                }
                return $total;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contratos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
