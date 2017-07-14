<?php

/**
 * This is the model class for table "nota_credito".
 *
 * The followings are the available columns in table 'nota_credito':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $n_identificacion
 * @property integer $contrato_id
 * @property string $valor
 * @property string $observaciones
 * @property string $fecha
 * @property string $fecha_hora
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Contratos $contrato
 * @property Personal $personal
 */
class NotaCredito extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nota_credito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, n_identificacion, contrato_id, valor, observaciones, fecha, fecha_hora, personal_id', 'required'),
			array('paciente_id, contrato_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('n_identificacion', 'length', 'max'=>30),
			array('valor', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, n_identificacion, contrato_id, valor, contrato_asociado_id, observaciones, fecha, fecha_hora, personal_id', 'safe', 'on'=>'search'),
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
			'contratoAsociado' => array(self::BELONGS_TO, 'Contratos', 'contrato_asociado_id'),
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
			'paciente_id' => 'Paciente',
			'n_identificacion' => 'N Identificacion',
			'contrato_id' => 'Contrato',
			'valor' => 'Valor',
			'observaciones' => 'Observaciones',
			'fecha' => 'Fecha',
			'fecha_hora' => 'Fecha Hora',
			'personal_id' => 'Personal',
			'contrato_asociado_id' => 'Contrato Asociado',
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
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		//$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('fecha_hora',$this->fecha_hora,true);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('contrato_asociado_id',$this->contrato_asociado_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'criteria'=>array('condition'=>'t.contrato_asociado_id is NULL'),
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'fecha DESC',
			    'attributes'=>array(
			),
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotaCredito the static model class
	 */

	public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->valor;
                        $total += $t;
                }
                return $total;
        }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
