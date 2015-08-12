<?php

/**
 * This is the model class for table "linea_servicio".
 *
 * The followings are the available columns in table 'linea_servicio':
 * @property integer $id
 * @property string $nombre
 * @property integer $tipo_id
 * @property string $precio
 * @property string $precio_pago
 * @property string $insumo
 * @property string $estado
 * @property integer $porcentaje
 * @property string $restringido
 *
 * The followings are the available model relations:
 * @property TipoLineaServicio $tipo
 */
class LineaServicio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'linea_servicio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('precio, precio_pago, insumo, porcentaje', 'required'),
			array('tipo_id, porcentaje, equipo_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>254),
			array('precio, precio_pago, insumo, estado', 'length', 'max'=>10),
			array('restringido', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, tipo_id, precio, precio_pago, insumo, estado, porcentaje, tipo_hoja_gastos, restringido', 'safe', 'on'=>'search'),
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
			'tipo' => array(self::BELONGS_TO, 'TipoLineaServicio', 'tipo_id'),
			'equipos' => array(self::BELONGS_TO, 'Equipos', 'equipo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'tipo_id' => 'Tipo',
			'precio' => 'Precio ($)',
			'precio_pago' => 'Precio a Pagar ($)',
			'insumo' => 'Precio de Insumo ($)',
			'estado' => 'Estado',
			'porcentaje' => 'Porcentaje (%)',
			'restringido' => 'Restringido',
			'equipo_id' => 'Equípo Vinculado',
			'tipo_hoja_gastos' => 'Hoja de Gastos',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tipo_id',$this->tipo_id);
		$criteria->compare('equipo_id',$this->equipo_id);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('precio_pago',$this->precio_pago,true);
		$criteria->compare('insumo',$this->insumo,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('porcentaje',$this->porcentaje);
		$criteria->compare('restringido',$this->restringido,true);
		$criteria->compare('tipo_hoja_gastos',$this->tipo_hoja_gastos,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LineaServicio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
