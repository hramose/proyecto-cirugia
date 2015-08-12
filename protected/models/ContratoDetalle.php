<?php

/**
 * This is the model class for table "contrato_detalle".
 *
 * The followings are the available columns in table 'contrato_detalle':
 * @property integer $id
 * @property integer $contrato_id
 * @property integer $linea_servicio_id
 * @property integer $cantidad
 * @property string $vu
 * @property integer $desc
 * @property string $vu_desc
 * @property string $vt_sin_desc
 * @property string $vt_con_desc
 * @property string $total
 *
 * The followings are the available model relations:
 * @property LineaServicio $lineaServicio
 * @property Contratos $contrato
 */
class ContratoDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contrato_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('contrato_id, linea_servicio_id, cantidad, vu, desc, vu_desc, vt_sin_desc, vt_con_desc, total', 'required'),
			array('contrato_id, linea_servicio_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('vu, vu_desc, vt_sin_desc, vt_con_desc, total', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contrato_id, linea_servicio_id, cantidad, realizadas, vu, desc, estado, vu_desc, vt_sin_desc, vt_con_desc, total', 'safe', 'on'=>'search'),
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
			'linea_servicio_id' => 'Linea Servicio',
			'cantidad' => 'Cantidad',
			'realizadas' => 'Realizadas',
			'vu' => 'Vu',
			'desc' => 'Desc',
			'vu_desc' => 'Vu Desc',
			'vt_sin_desc' => 'Vt Sin Desc',
			'vt_con_desc' => 'Vt Con Desc',
			'total' => 'Total',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('realizadas',$this->realizadas);
		$criteria->compare('vu',$this->vu,true);
		$criteria->compare('desc',$this->desc);
		$criteria->compare('vu_desc',$this->vu_desc,true);
		$criteria->compare('vt_sin_desc',$this->vt_sin_desc,true);
		$criteria->compare('vt_con_desc',$this->vt_con_desc,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContratoDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
