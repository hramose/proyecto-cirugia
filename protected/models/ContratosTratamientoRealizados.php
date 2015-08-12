<?php

/**
 * This is the model class for table "contratos_tratamiento_realizados".
 *
 * The followings are the available columns in table 'contratos_tratamiento_realizados':
 * @property integer $id
 * @property integer $contrato_id
 * @property integer $cita_id
 * @property integer $linea_servicio_id
 * @property integer $sesion
 *
 * The followings are the available model relations:
 * @property LineaServicio $lineaServicio
 * @property Contratos $contrato
 * @property Citas $cita
 */
class ContratosTratamientoRealizados extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contratos_tratamiento_realizados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contrato_id, cita_id, linea_servicio_id, sesion', 'required'),
			array('contrato_id, cita_id, linea_servicio_id, sesion', 'numerical', 'integerOnly'=>true),
			array('cita_id', 'unique'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contrato_id, cita_id, linea_servicio_id, sesion', 'safe', 'on'=>'search'),
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
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'contrato_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contrato_id' => 'Contrato',
			'cita_id' => 'Cita',
			'linea_servicio_id' => 'Linea Servicio',
			'sesion' => 'Sesion',
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
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('sesion',$this->sesion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContratosTratamientoRealizados the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
