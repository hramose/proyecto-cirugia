<?php

/**
 * This is the model class for table "presupuesto".
 *
 * The followings are the available columns in table 'presupuesto':
 * @property integer $id
 * @property integer $paciente_id
 * @property string $total
 * @property integer $fecha
 * @property integer $usuario_id
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property PresupuestoDetalle[] $presupuestoDetalles
 */
class Presupuesto extends CActiveRecord
{

	public $nombre_paciente;
	public $apellido_paciente;
	public $n_identificacion;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'presupuesto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('paciente_id, total, fecha, usuario_id, estado', 'required'),
			array('paciente_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('total', 'length', 'max'=>15),
			array('estado', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, total, fecha, adicionales, usuario_id, nombre_paciente, n_identificacion, apellido_paciente, vendedor_id, estado, observaciones', 'safe', 'on'=>'search'),
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
			'elusuario' => array(self::BELONGS_TO, 'Personal', 'usuario_id'),
			'vendedor' => array(self::BELONGS_TO, 'Personal', 'vendedor_id'),
			'presupuestoDetalles' => array(self::HAS_MANY, 'PresupuestoDetalle', 'presupuesto_id'),
			
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
			'total' => 'Total',
			'fecha' => 'Fecha',
			'usuario_id' => 'Usuario',
			'vendedor_id' => 'Vendedor',
			//'n_identificacion' => 'Cedula',
			'estado' => 'Estado',
			'observaciones' => 'Observaciones',
			'adicionales' => 'Adicionales',
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('paciente_id',$this->paciente_id);
		//$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('DATE_FORMAT(fecha, \'%d-%m-%Y\')',$this->fecha,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('vendedor_id',$this->vendedor_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->with = array('paciente');
		$criteria->compare('paciente.n_identificacion', $this->n_identificacion, true );
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'t.id DESC',
			    'attributes'=>array(
			    	'desc'=>'t.id desc',
			),
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Presupuesto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
