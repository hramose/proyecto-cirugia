<?php

/**
 * This is the model class for table "cosmetologa_orden".
 *
 * The followings are the available columns in table 'cosmetologa_orden':
 * @property integer $id
 * @property integer $contrato_detalle_id
 * @property string $sesion
 * @property integer $cosmetologa_id
 * @property string $estado
 * @property string $fecha_servicio
 * @property string $fecha_pago
 *
 * The followings are the available model relations:
 * @property Personal $cosmetologa
 * @property ContratoDetalle $contratoDetalle
 */
class CosmetologaOrden extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cosmetologa_orden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contrato_detalle_id, sesion, cosmetologa_id, estado, fecha_servicio, fecha_pago', 'required'),
			array('contrato_detalle_id, cosmetologa_id', 'numerical', 'integerOnly'=>true),
			array('sesion', 'length', 'max'=>4),
			array('estado', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contrato_detalle_id, sesion, cosmetologa_id, estado, fecha_servicio, fecha_pago', 'safe', 'on'=>'search'),
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
			'cosmetologa' => array(self::BELONGS_TO, 'Personal', 'cosmetologa_id'),
			'contratoDetalle' => array(self::BELONGS_TO, 'ContratoDetalle', 'contrato_detalle_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contrato_detalle_id' => 'Contrato Detalle',
			'sesion' => 'Sesion',
			'cosmetologa_id' => 'Cosmetologa',
			'estado' => 'Estado',
			'fecha_servicio' => 'Fecha Servicio',
			'fecha_pago' => 'Fecha Pago',
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
		$criteria->compare('contrato_detalle_id',$this->contrato_detalle_id);
		$criteria->compare('sesion',$this->sesion,true);
		$criteria->compare('cosmetologa_id',$this->cosmetologa_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha_servicio',$this->fecha_servicio,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CosmetologaOrden the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
