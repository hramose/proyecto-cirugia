<?php

/**
 * This is the model class for table "ventas_detalle".
 *
 * The followings are the available columns in table 'ventas_detalle':
 * @property integer $id
 * @property integer $venta_id
 * @property integer $producto_id
 * @property integer $cantidad
 * @property string $valor
 * @property string $iva
 * @property string $total
 *
 * The followings are the available model relations:
 * @property Ventas $venta
 * @property ProductoInventario $producto
 */
class VentasDetalle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ventas_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public $vendedor_id;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('venta_id, producto_id, cantidad, valor, iva, total', 'required'),
			array('venta_id, producto_id, cantidad', 'numerical', 'integerOnly'=>true),
			array('valor, iva, total', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, venta_id, producto_id, cantidad, lote, paciente_id, vendedor_id, fecha, valor, iva, total', 'safe', 'on'=>'search'),
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
			'venta' => array(self::BELONGS_TO, 'Ventas', 'venta_id'),
			'producto' => array(self::BELONGS_TO, 'ProductoInventario', 'producto_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'venta_id' => 'Venta',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
			'valor' => 'Valor',
			'iva' => 'Iva',
			'total' => 'Total',
			'fecha' => 'Fecha',
			'lote' => 'Lote',
			'paciente_id' => 'Compro',
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
		$criteria->compare('venta_id',$this->venta_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('t.paciente_id',$this->paciente_id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('iva',$this->iva,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('DATE_FORMAT(t.fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->with = array('venta');
		$criteria->compare('venta.vendedor_id', $this->vendedor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	public function searchSuma()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('venta_id',$this->venta_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('t.paciente_id',$this->paciente_id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('iva',$this->iva,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('DATE_FORMAT(t.fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->with = array('venta');
		$criteria->compare('venta.vendedor_id', $this->vendedor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>900000),
		));
	}

 	public static function getTotal($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->valor;
                        $total += $t;
                }
                return $total;
        }

    public static function getTotal2($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->iva;
                        $total += $t;
                }
                return $total;
        }

    public static function getTotal3($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->total;
                        $total += $t;
                }
                return $total;
        }

    public static function getTotal4($provider)
        {
                $total=0;
                foreach($provider->data as $data)
                {
                        //$t = $data->perkakas+$data->alat_tulis+$data->barang_cetakan+
                        //        $data->honorarium+$data->perjalanan_dinas+$data->konsumsi;
                		$t = $data->cantidad;
                        $total += $t;
                }
                return $total;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VentasDetalle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
