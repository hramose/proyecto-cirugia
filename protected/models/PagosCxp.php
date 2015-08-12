<?php

/**
 * This is the model class for table "pagos_cxp".
 *
 * The followings are the available columns in table 'pagos_cxp':
 * @property integer $id
 * @property integer $producto_compra_id
 * @property string $pago
 * @property string $comentario
 * @property string $fecha
 * @property integer $personal_id
 *
 * The followings are the available model relations:
 * @property ProductoCompras $productoCompra
 * @property Personal $personal
 */
class PagosCxp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagos_cxp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_compra_id, pago, comentario, fecha, personal_id', 'required'),
			array('producto_compra_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('pago', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, producto_compra_id, pago, comentario, fecha, personal_id', 'safe', 'on'=>'search'),
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
			'productoCompra' => array(self::BELONGS_TO, 'ProductoCompras', 'producto_compra_id'),
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
			'producto_compra_id' => 'Producto Compra',
			'pago' => 'Pago',
			'comentario' => 'Comentario',
			'fecha' => 'Fecha',
			'personal_id' => 'Personal',
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
		$criteria->compare('producto_compra_id',$this->producto_compra_id);
		$criteria->compare('pago',$this->pago,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('personal_id',$this->personal_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PagosCxp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
