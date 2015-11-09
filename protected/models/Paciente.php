<?php

/**
 * This is the model class for table "paciente".
 *
 * The followings are the available columns in table 'paciente':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $n_identificacion
 * @property integer $genero
 * @property string $fecha_nacimiento
 * @property string $fecha_registro
 * @property string $email
 * @property string $email2
 * @property string $telefono1
 * @property string $telefono2
 * @property string $celular
 * @property string $direccion
 * @property string $ciudad
 * @property string $pais
 * @property string $referer_contact
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $tipo_vinculacion
 * @property string $Aseguradora
 * @property string $nombre_acompanante
 * @property string $acompanante_telefono
 * @property string $nombre_responsable
 * @property string $relacion_responsable
 * @property string $telefono_responsable
 * @property string $responsable
 * @property string $historia_id
 * @property integer $tratamiento_interes_id
 * @property integer $fuente_contacto_id
 *
 * The followings are the available model relations:
 * @property TratamientoInteres $tratamientoInteres
 * @property FuenteContacto $fuenteContacto
 */
class Paciente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('referer_contact, estado_civil, ocupacion, tipo_vinculacion, Aseguradora, nombre_acompanante, acompanante_telefono, nombre_responsable, relacion_responsable, telefono_responsable, responsable, historia_id', 'required'),
			array('fuente_contacto_id', 'required'),
			array('genero, tratamiento_interes_id, fuente_contacto_id', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido, n_identificacion, email, email2, telefono1, telefono2, celular, direccion, ciudad, pais, referer_contact, ocupacion, tipo_vinculacion, Aseguradora, nombre_acompanante, acompanante_telefono, nombre_responsable, relacion_responsable, telefono_responsable, historia_id', 'length', 'max'=>254),
			array('estado_civil', 'length', 'max'=>20),
			array('responsable', 'length', 'max'=>100),
			array('fecha_nacimiento, fecha_registro', 'safe'),
			array('nombre, apellido, n_identificacion, celular, email, tratamiento_interes_id', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, saldo, apellido, n_identificacion, observaciones, genero, fecha_nacimiento, fecha_registro, email, email2, telefono1, telefono2, celular, direccion, ciudad, pais, referer_contact, estado_civil, ocupacion, tipo_vinculacion, Aseguradora, nombre_acompanante, acompanante_telefono, nombre_responsable, relacion_responsable, telefono_responsable, responsable, historia_id, tratamiento_interes_id, fuente_contacto_id', 'safe', 'on'=>'search'),
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
			'tratamientoInteres' => array(self::BELONGS_TO, 'TratamientoInteres', 'tratamiento_interes_id'),
			'fuenteContacto' => array(self::BELONGS_TO, 'FuenteContacto', 'fuente_contacto_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombres',
			'apellido' => 'Apellidos',
			'n_identificacion' => 'N° de Identificación',
			'genero' => 'Genero',
			'fecha_nacimiento' => 'Fecha de Nacimiento',
			'fecha_registro' => 'Fecha de Registro',
			'email' => 'Email 1',
			'email2' => 'Email 2',
			'telefono1' => 'Teléfono 1',
			'telefono2' => 'Teléfono 2',
			'celular' => 'Celular',
			'direccion' => 'Dirección',
			'ciudad' => 'Ciudad',
			'pais' => 'Pais',
			'referer_contact' => 'Referer Contact',
			'estado_civil' => 'Estado Civil',
			'ocupacion' => 'Ocupación',
			'tipo_vinculacion' => 'Tipo de Vinculación',
			'Aseguradora' => 'EPS',
			'nombre_acompanante' => 'Nombre de Acompanante',
			'acompanante_telefono' => 'Teléfono de Acompañante',
			'nombre_responsable' => 'Nombre de Responsable',
			'relacion_responsable' => 'Relacion con Responsable',
			'telefono_responsable' => 'Teléfono de Responsable',
			'responsable' => 'Responsable',
			'historia_id' => 'Asignar Historia Clinica',
			'tratamiento_interes_id' => 'Tratamiento de Interes',
			'fuente_contacto_id' => 'Fuente de Contacto',
			'observaciones' => 'Observaciones',
			'saldo' => 'Saldo en Caja',
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
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('DATE_FORMAT(fecha_nacimiento, \'%d-%m-%Y\')',$this->fecha_nacimiento,true);
		//$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('telefono1',$this->telefono1,true);
		$criteria->compare('telefono2',$this->telefono2,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('referer_contact',$this->referer_contact,true);
		$criteria->compare('estado_civil',$this->estado_civil,true);
		$criteria->compare('ocupacion',$this->ocupacion,true);
		$criteria->compare('tipo_vinculacion',$this->tipo_vinculacion,true);
		$criteria->compare('Aseguradora',$this->Aseguradora,true);
		$criteria->compare('nombre_acompanante',$this->nombre_acompanante,true);
		$criteria->compare('acompanante_telefono',$this->acompanante_telefono,true);
		$criteria->compare('nombre_responsable',$this->nombre_responsable,true);
		$criteria->compare('relacion_responsable',$this->relacion_responsable,true);
		$criteria->compare('telefono_responsable',$this->telefono_responsable,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('historia_id',$this->historia_id,true);
		$criteria->compare('tratamiento_interes_id',$this->tratamiento_interes_id);
		$criteria->compare('fuente_contacto_id',$this->fuente_contacto_id);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	public function searchCajas()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('n_identificacion',$this->n_identificacion,true);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('DATE_FORMAT(fecha_nacimiento, \'%d-%m-%Y\')',$this->fecha_nacimiento,true);
		//$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email2',$this->email2,true);
		$criteria->compare('telefono1',$this->telefono1,true);
		$criteria->compare('telefono2',$this->telefono2,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('referer_contact',$this->referer_contact,true);
		$criteria->compare('estado_civil',$this->estado_civil,true);
		$criteria->compare('ocupacion',$this->ocupacion,true);
		$criteria->compare('tipo_vinculacion',$this->tipo_vinculacion,true);
		$criteria->compare('Aseguradora',$this->Aseguradora,true);
		$criteria->compare('nombre_acompanante',$this->nombre_acompanante,true);
		$criteria->compare('acompanante_telefono',$this->acompanante_telefono,true);
		$criteria->compare('nombre_responsable',$this->nombre_responsable,true);
		$criteria->compare('relacion_responsable',$this->relacion_responsable,true);
		$criteria->compare('telefono_responsable',$this->telefono_responsable,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('historia_id',$this->historia_id,true);
		$criteria->compare('tratamiento_interes_id',$this->tratamiento_interes_id);
		$criteria->compare('fuente_contacto_id',$this->fuente_contacto_id);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'criteria'=>array('condition'=>'saldo > 0'),
			'pagination'=>array('pageSize'=>20),
		));
	}


	public function suggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'n_identificacion LIKE :keyword or nombre LIKE :keyword',
			'order'=>'n_identificacion',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
				'label'=>$model->n_identificacion.' - '.$model->nombreCompleto,  // label for dropdown list
				'value'=>$model->n_identificacion,  // value for input field
				'id'=>$model->id,       // return values from autocomplete
				'nombre'=>$model->nombreCompleto,
				'direccion'=>$model->direccion,
				'ciudad'=>$model->ciudad,
				'telefono'=>$model->telefono1,
				'paciente_id'=>$model->id,
			);
		}
		return $suggest;
	}
	/**
	 * Suggests a list of existing fullnames matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of names to be returned
	 * @return array list of matching fullnames
	 */
	public function legacySuggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'name',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model)
			$suggest[]=$model->name.' - '.$model->code.' - '.$model->call_code.'|'.$model->name.'|'.$model->code.'|'.$model->call_code;
		return $suggest;
	}




	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paciente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	function getNombreCompleto()
	{
	    return $this->nombre.' '.$this->apellido;
	}
}
