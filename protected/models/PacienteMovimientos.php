<?php

/**
 * This is the model class for table "paciente_movimientos".
 *
 * The followings are the available columns in table 'paciente_movimientos':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $valor
 * @property string $tipo
 * @property string $sub_tipo
 * @property string $descripcion
 * @property integer $usuario_id
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Usuarios $usuario
 */
class PacienteMovimientos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente_movimientos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, valor, tipo, sub_tipo, descripcion, usuario_id, fecha', 'required'),
			array('paciente_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>10),
			array('tipo', 'length', 'max'=>15),
			array('sub_tipo', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, valor, tipo, sub_tipo, descripcion, usuario_id, fecha', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'usuario_id'),
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
			'valor' => 'Valor',
			'tipo' => 'Tipo',
			'sub_tipo' => 'Sub Tipo',
			'descripcion' => 'Descripcion',
			'usuario_id' => 'Usuario',
			'fecha' => 'Fecha',
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
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('sub_tipo',$this->sub_tipo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PacienteMovimientos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
