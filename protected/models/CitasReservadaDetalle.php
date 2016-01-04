<?php

/**
 * This is the model class for table "citas_reservada_detalle".
 *
 * The followings are the available columns in table 'citas_reservada_detalle':
 * @property integer $cita_reservada_id
 * @property integer $cita_id
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property CitasReservada $citaReservada
 * @property Citas $cita
 */
class CitasReservadaDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'citas_reservada_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cita_reservada_id, cita_id, estado', 'required'),
			array('cita_reservada_id, cita_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cita_reservada_id, cita_id, estado', 'safe', 'on'=>'search'),
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
			'citaReservada' => array(self::BELONGS_TO, 'CitasReservada', 'cita_reservada_id'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cita_reservada_id' => 'Cita Reservada',
			'cita_id' => 'Cita',
			'estado' => 'Estado',
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

		$criteria->compare('cita_reservada_id',$this->cita_reservada_id);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CitasReservadaDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
