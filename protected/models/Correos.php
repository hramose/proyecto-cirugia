<?php

/**
 * This is the model class for table "correos".
 *
 * The followings are the available columns in table 'correos':
 * @property integer $id
 * @property string $tipo
 * @property string $detalle
 * @property string $pie
 * @property string $fecha_actualizado
 * @property integer $usuario_id
 */
class Correos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'correos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, detalle, pie', 'required'),
			array('usuario_id', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>30),
			array('fecha_actualizado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo, detalle, pie, fecha_actualizado, usuario_id', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Personal', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipo' => 'Tipo',
			'detalle' => 'Detalle',
			'pie' => 'Pie',
			'fecha_actualizado' => 'Fecha Actualizado',
			'usuario_id' => 'Usuario',
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
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('pie',$this->pie,true);
		$criteria->compare('fecha_actualizado',$this->fecha_actualizado,true);
		$criteria->compare('usuario_id',$this->usuario_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Correos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
