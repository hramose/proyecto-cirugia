<?php

/**
 * This is the model class for table "historial_formulacion_detalle".
 *
 * The followings are the available columns in table 'historial_formulacion_detalle':
 * @property integer $id
 * @property integer $formulacion_id
 * @property string $otra_formulacion
 * @property string $formulacion
 * @property integer $historial_formulacion_id
 *
 * The followings are the available model relations:
 * @property HistorialFormulacion $historialFormulacion
 * @property Formulacion $formulacion0
 */
class HistorialFormulacionDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_formulacion_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('historial_formulacion_id', 'required'),
			array('formulacion_id, historial_formulacion_id', 'numerical', 'integerOnly'=>true),
			array('otra_formulacion', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, formulacion_id, otra_formulacion, formulacion, historial_formulacion_id', 'safe', 'on'=>'search'),
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
			'historialFormulacion' => array(self::BELONGS_TO, 'HistorialFormulacion', 'historial_formulacion_id'),
			'laformulacion' => array(self::BELONGS_TO, 'Formulacion', 'formulacion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'formulacion_id' => 'Formulacion',
			'otra_formulacion' => 'Otra Formulacion',
			'formulacion' => 'Formulacion',
			'historial_formulacion_id' => 'Historial Formulacion',
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
		$criteria->compare('formulacion_id',$this->formulacion_id);
		$criteria->compare('otra_formulacion',$this->otra_formulacion,true);
		$criteria->compare('formulacion',$this->formulacion,true);
		$criteria->compare('historial_formulacion_id',$this->historial_formulacion_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialFormulacionDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
