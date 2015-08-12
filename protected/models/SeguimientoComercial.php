<?php

/**
 * This is the model class for table "seguimiento_comercial".
 *
 * The followings are the available columns in table 'seguimiento_comercial':
 * @property integer $id
 * @property string $fecha_registro
 * @property string $tipo
 * @property integer $cita_id
 * @property string $n_identificacion
 * @property integer $paciente_id
 * @property string $fecha_accion
 * @property string $fecha_atencion
 * @property integer $tema_id
 * @property integer $id_personal
 * @property string $observaciones
 * @property string $estado
 * @property string $comentario_estado
 * @property string $paciente_documento
 * @property string $ultimo_seguimiento
 * @property integer $responsable_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Personal $idPersonal
 * @property Citas $cita
 * @property SeguimientoTema $tema
 * @property Personal $responsable
 */
class SeguimientoComercial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguimiento_comercial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('fecha_registro, tipo, n_identificacion, fecha_accion, fecha_atencion, tema_id, id_personal, observaciones, estado, comentario_estado, paciente_documento, ultimo_seguimiento', 'required'),
			array('cita_id, paciente_id, tema_id, id_personal, responsable_id', 'numerical', 'integerOnly'=>true),
			array('tipo, n_identificacion, estado, paciente_documento', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_registro, tipo, cita_id, n_identificacion, paciente_id, fecha_accion, fecha_atencion, tema_id, id_personal, observaciones, estado, comentario_estado, paciente_documento, ultimo_seguimiento, responsable_id', 'safe', 'on'=>'search'),
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
			'idPersonal' => array(self::BELONGS_TO, 'Personal', 'id_personal'),
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'tema' => array(self::BELONGS_TO, 'SeguimientoTema', 'tema_id'),
			'responsable' => array(self::BELONGS_TO, 'Personal', 'responsable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_registro' => 'Fecha Registro',
			'tipo' => 'Tipo',
			'cita_id' => 'Cita',
			'n_identificacion' => 'N Identificacion',
			'paciente_id' => 'Paciente',
			'fecha_accion' => 'Fecha Accion',
			'fecha_atencion' => 'Fecha Atencion',
			'tema_id' => 'Tema',
			'id_personal' => 'Id Personal',
			'observaciones' => 'Observaciones',
			'estado' => 'Estado',
			'comentario_estado' => 'Comentario Estado',
			'paciente_documento' => 'Paciente Documento',
			'ultimo_seguimiento' => 'Ultimo Seguimiento',
			'responsable_id' => 'Responsable',
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
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('DATE_FORMAT(fecha_accion, \'%d-%m-%Y\')',$this->fecha_accion,true);
		$criteria->compare('fecha_atencion',$this->fecha_atencion,true);
		$criteria->compare('tema_id',$this->tema_id);
		$criteria->compare('id_personal',$this->id_personal);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('comentario_estado',$this->comentario_estado,true);
		$criteria->compare('paciente_documento',$this->paciente_documento,true);
		$criteria->compare('ultimo_seguimiento',$this->ultimo_seguimiento,true);
		$criteria->compare('responsable_id',$this->responsable_id);

		return new CActiveDataProvider('seguimientoComercial', array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
						    'defaultOrder'=>'fecha_accion ASC',
						    'attributes'=>array(
						    'paciente_id'=>array(
								'asc'=>'elpaciente.nombreCompleto',
								'desc'=>'elpaciente.nombreCompleto desc',
							),
							// 'n_identificacion'=>array(
							// 	'asc'=>'paciente.n_identificacion',
							// 	'desc'=>'paciente.n_identificacion desc',
							// ),
						),
						),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SeguimientoComercial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
