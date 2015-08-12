<?php

/**
 * This is the model class for table "historial_medicina_biologica_detalle".
 *
 * The followings are the available columns in table 'historial_medicina_biologica_detalle':
 * @property integer $id
 * @property integer $sesion
 * @property integer $historial_medicina_biologica_id
 * @property integer $ciclo
 * @property integer $medicamentos_biologicos_id
 *
 * The followings are the available model relations:
 * @property HistorialMedicinaBiologica $historialMedicinaBiologica
 * @property MedicamentosBiologicos $medicamentosBiologicos
 */
class HistorialMedicinaBiologicaDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_medicina_biologica_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sesion, historial_medicina_biologica_id, ciclo, medicamentos_biologicos_id', 'required'),
			array('sesion, historial_medicina_biologica_id, ciclo, medicamentos_biologicos_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sesion, historial_medicina_biologica_id, ciclo, medicamentos_biologicos_id', 'safe', 'on'=>'search'),
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
			'historialMedicinaBiologica' => array(self::BELONGS_TO, 'HistorialMedicinaBiologica', 'historial_medicina_biologica_id'),
			'medicamentosBiologicos' => array(self::BELONGS_TO, 'MedicamentosBiologicos', 'medicamentos_biologicos_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sesion' => 'Sesion',
			'historial_medicina_biologica_id' => 'Historial Medicina Biologica',
			'ciclo' => 'Ciclo',
			'medicamentos_biologicos_id' => 'Medicamentos Biologicos',
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
		$criteria->compare('sesion',$this->sesion);
		$criteria->compare('historial_medicina_biologica_id',$this->historial_medicina_biologica_id);
		$criteria->compare('ciclo',$this->ciclo);
		$criteria->compare('medicamentos_biologicos_id',$this->medicamentos_biologicos_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialMedicinaBiologicaDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
