<?php

/**
 * This is the model class for table "paciente_orden".
 *
 * The followings are the available columns in table 'paciente_orden':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $observaciones
 * @property integer $vendedor
 * @property string $estado
 * @property string $abierto_cerrado
 * @property string $fecha
 * @property integer $responsable
 *
 * The followings are the available model relations:
 * @property Personal $responsable0
 * @property Personal $vendedor0
 */
class PacienteOrden extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente_orden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vendedor', 'required'),
			array('paciente_id, vendedor, responsable', 'numerical', 'integerOnly'=>true),
			array('estado, abierto_cerrado', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, observaciones, vendedor, estado, abierto_cerrado, fecha, responsable', 'safe', 'on'=>'search'),
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
			'responsable0' => array(self::BELONGS_TO, 'Personal', 'responsable'),
			'vendedor0' => array(self::BELONGS_TO, 'Personal', 'vendedor'),
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
			'observaciones' => 'Observaciones',
			'vendedor' => 'Vendedor',
			'estado' => 'Estado',
			'abierto_cerrado' => 'Abierto Cerrado',
			'fecha' => 'Fecha',
			'responsable' => 'Responsable',
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
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('vendedor',$this->vendedor);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('abierto_cerrado',$this->abierto_cerrado,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('responsable',$this->responsable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PacienteOrden the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
