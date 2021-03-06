<?php

/**
 * This is the model class for table "cuentas_xc".
 *
 * The followings are the available columns in table 'cuentas_xc':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $n_identificacion
 * @property string $saldo
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property CuentasXcDetalle[] $cuentasXcDetalles
 */
class CuentasXc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $nombre_paciente;
	public $apellido_paciente;

	public function tableName()
	{
		return 'cuentas_xc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, n_identificacion, saldo', 'required'),
			array('paciente_id', 'numerical', 'integerOnly'=>true),
			array('n_identificacion', 'length', 'max'=>30),
			array('saldo', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, n_identificacion, saldo, nombre_paciente, apellido_paciente', 'safe', 'on'=>'search'),
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
			'cuentasXcDetalles' => array(self::HAS_MANY, 'CuentasXcDetalle', 'cuentas_xc_id'),
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.paciente_id',$this->paciente_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('t.saldo',$this->saldo,true);
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );
		$criteria->addCondition("t.saldo != 0");


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'criteria'=>array('condition'=>'t.saldo != 0'),
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'t.id DESC',
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
		$criteria->compare('t.paciente_id',$this->paciente_id);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('t.saldo',$this->saldo,true);
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );
		$criteria->addCondition("t.saldo != 0");


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'criteria'=>array('condition'=>'t.saldo != 0'),
			'pagination'=>array('pageSize'=>9000000),
			));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CuentasXc the static model class
	 */

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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
