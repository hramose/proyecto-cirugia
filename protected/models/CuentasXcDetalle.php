<?php

/**
 * This is the model class for table "cuentas_xc_detalle".
 *
 * The followings are the available columns in table 'cuentas_xc_detalle':
 * @property integer $id
 * @property integer $cuentas_xc_id
 * @property integer $paciente_id
 * @property string $n_identificacion
 * @property integer $cita_id
 * @property integer $contrato_id
 * @property string $saldo
 *
 * The followings are the available model relations:
 * @property CuentasXc $cuentasXc
 * @property Paciente $paciente
 * @property Citas $cita
 * @property Contratos $contrato
 */
class CuentasXcDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cuentas_xc_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuentas_xc_id, paciente_id, n_identificacion, saldo', 'required'),
			array('cuentas_xc_id, paciente_id, cita_id, contrato_id', 'numerical', 'integerOnly'=>true),
			array('n_identificacion', 'length', 'max'=>30),
			array('saldo', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cuentas_xc_id, paciente_id, n_identificacion, cita_id, contrato_id, saldo, linea_servicio_id', 'safe', 'on'=>'search'),
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
			'cuentasXc' => array(self::BELONGS_TO, 'CuentasXc', 'cuentas_xc_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'contrato_id'),
			'linea' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cuentas_xc_id' => 'Cuentas Xc',
			'paciente_id' => 'Paciente',
			'n_identificacion' => 'N Identificacion',
			'cita_id' => 'Cita',
			'contrato_id' => 'Contrato',
			'linea_servicio_id' => 'Linea de Servicio',
			'saldo' => 'Saldo',
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
		$criteria->compare('cuentas_xc_id',$this->cuentas_xc_id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('saldo',$this->saldo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'criteria'=>array('condition'=>'saldo != 0 and contrato_id > 0'),
			'pagination'=>array('pageSize'=>20),
		));
	}
	public function search2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('cuentas_xc_id',$this->cuentas_xc_id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('saldo',$this->saldo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'criteria'=>array('condition'=>'saldo != 0 and linea_servicio_id > 0'),
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
                		$t = $data->saldo;
                        $total += $t;
                }
                return $total;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CuentasXcDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
