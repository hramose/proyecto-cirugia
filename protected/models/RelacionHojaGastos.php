<?php

/**
 * This is the model class for table "relacion_hoja_gastos".
 *
 * The followings are the available columns in table 'relacion_hoja_gastos':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $hoja
 * @property integer $asistencial_id
 * @property integer $cita_id
 * @property integer $linea_servicio_id
 * @property string $fecha
 * @property string $fecha_hora
 * @property string $costo
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Personal $asistencial
 * @property Citas $cita
 * @property LineaServicio $lineaServicio
 * @property Personal $personal
 */
class RelacionHojaGastos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'relacion_hoja_gastos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, hoja, asistencial_id, cita_id, linea_servicio_id, fecha, fecha_hora, costo, personal_id', 'required'),
			array('paciente_id, asistencial_id, cita_id, linea_servicio_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('hoja', 'length', 'max'=>30),
			array('costo', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, hoja, asistencial_id, n_identificacion, cita_id, linea_servicio_id, fecha, fecha_hora, costo, personal_id', 'safe', 'on'=>'search'),
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
			'asistencial' => array(self::BELONGS_TO, 'Personal', 'asistencial_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
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
			'hoja' => 'Hoja',
			'asistencial_id' => 'Asistencial',
			'cita_id' => 'Cita',
			'linea_servicio_id' => 'Linea Servicio',
			'fecha' => 'Fecha',
			'fecha_hora' => 'Fecha Hora',
			'costo' => 'Costo',
			'personal_id' => 'Personal',
			'n_identificacion' => 'Cedula',
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
		$criteria->compare('hoja',$this->hoja,true);
		$criteria->compare('asistencial_id',$this->asistencial_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('fecha_hora',$this->fecha_hora,true);
		$criteria->compare('costo',$this->costo,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('hoja',$this->hoja,true);
		$criteria->compare('asistencial_id',$this->asistencial_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('fecha_hora',$this->fecha_hora,true);
		$criteria->compare('costo',$this->costo,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>9999999999999999),
		));
	}

public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->costo;
                        $total += $t;
                }
                return $total;
        }



	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RelacionHojaGastos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
