<?php

/**
 * This is the model class for table "personal".
 *
 * The followings are the available columns in table 'personal':
 * @property integer $id
 * @property string $cc
 * @property string $expedicion
 * @property string $titulo
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $lugar_nacimiento
 * @property string $genero
 * @property string $direccion
 * @property string $telefono
 * @property string $ciudad
 * @property string $celular
 * @property string $correo
 * @property string $arp
 * @property string $cualarp
 * @property string $pension
 * @property string $cualpension
 * @property string $salud
 * @property string $cualsalud
 * @property string $sangre
 * @property string $aprueba_ordenes
 * @property string $office
 * @property string $activo
 * @property string $medico
 * @property string $seguimiento
 * @property integer $id_perfil
 *
 * The followings are the available model relations:
 * @property Citas[] $citases
 * @property PacienteOrden[] $pacienteOrdens
 * @property PacienteOrden[] $pacienteOrdens1
 * @property Perfil $idPerfil
 */
class Personal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc, expedicion, nombres, apellidos, fecha_nacimiento, genero, direccion, telefono, departamento, sangre, ciudad, celular, correo, arp, pension, aprueba_ordenes, seguimiento, nombres_f, apellidos_f, direccion_f, telefono_f, celular_f, parentesco', 'required'),
			array('id_perfil', 'numerical', 'integerOnly'=>true),
			array('cc, expedicion, direccion, cualsalud', 'length', 'max'=>254),
			array('titulo', 'length', 'max'=>15),
			array('nombres, apellidos', 'length', 'max'=>50),
			array('lugar_nacimiento, correo, correo2, cualarp, cualpension, sangre, office', 'length', 'max'=>60),
			array('telefono, telefono2, ciudad, departamento, celular, celular2', 'length', 'max'=>20),
			array('arp, pension, salud, aprueba_ordenes, activo, medico, seguimiento', 'length', 'max'=>2),
			array('nombres_f, apellidos_f, direccion_f, telefono_f, celular_f, parentesco, barrio', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cc, expedicion, titulo, nombres, apellidos, agenda, fecha_nacimiento, lugar_nacimiento, genero, direccion, telefono, ciudad, celular, correo, arp, cualarp, pension, cualpension, salud, cualsalud, sangre, aprueba_ordenes, office, activo, medico, seguimiento, id_perfil', 'safe', 'on'=>'search'),
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
			'citases' => array(self::HAS_MANY, 'Citas', 'personal_id'),
			'pacienteOrdens' => array(self::HAS_MANY, 'PacienteOrden', 'vendedor'),
			'pacienteOrdens1' => array(self::HAS_MANY, 'PacienteOrden', 'responsable'),
			//'inventarios'=>array(self::HAS_MANY, 'InventarioPersonal', 'personal_id'),
			'idPerfil' => array(self::BELONGS_TO, 'Perfil', 'id_perfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cc' => 'Cedula Ciudadanía',
			'expedicion' => 'Expedicion',
			'titulo' => 'Titulo',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'fecha_nacimiento' => 'Fecha de Nacimiento',
			'lugar_nacimiento' => 'Lugar de Nacimiento',
			'genero' => 'Genero',
			'direccion' => 'Dirección',
			'telefono' => 'Teléfono 1',
			'telefono2' => 'Teléfono 2',
			'ciudad' => 'Ciudad',
			'celular' => 'Celular 1',
			'celular2' => 'Celular 2',
			'correo' => 'Correo',
			'correo2' => 'Correo 2',
			'arp' => 'ARP',
			'cualarp' => 'Cual Arp',
			'pension' => 'Pensión',
			'cualpension' => 'Cual Pensión',
			'salud' => 'Salud',
			'cualsalud' => 'Cual Salud',
			'sangre' => 'Sangre',
			'aprueba_ordenes' => 'Aprueba Ordenes',
			'office' => 'Office',
			'activo' => 'Activo',
			'medico' => 'Médico',
			'seguimiento' => 'Seguimiento',
			'id_perfil' => 'Perfil',
			'departamento' => 'Departamento',
			'nombres_f' => 'Nombres',
			'apellidos_f' => 'Apellidos',
			'direccion_f' => 'Dirección',
			'telefono_f' => 'Teléfono',
			'celular_f' => 'Celular',
			'parentesco' => 'Parentesco',
			'barrio' => 'Barrio',
			'agenda' => 'Agenda',

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
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('expedicion',$this->expedicion,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('lugar_nacimiento',$this->lugar_nacimiento,true);
		$criteria->compare('genero',$this->genero,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('telefono2',$this->telefono,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('celular2',$this->celular,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('correo2',$this->correo2,true);
		$criteria->compare('arp',$this->arp,true);
		$criteria->compare('cualarp',$this->cualarp,true);
		$criteria->compare('pension',$this->pension,true);
		$criteria->compare('cualpension',$this->cualpension,true);
		$criteria->compare('salud',$this->salud,true);
		$criteria->compare('cualsalud',$this->cualsalud,true);
		$criteria->compare('sangre',$this->sangre,true);
		$criteria->compare('aprueba_ordenes',$this->aprueba_ordenes,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('activo',$this->activo,true);
		$criteria->compare('medico',$this->medico,true);
		$criteria->compare('agenda',$this->agenda,true);
		$criteria->compare('seguimiento',$this->seguimiento,true);
		$criteria->compare('departamento',$this->departamento);
		$criteria->compare('nombres_f',$this->nombres_f);
		$criteria->compare('apellidos_f',$this->apellidos_f);
		$criteria->compare('direccion_f',$this->direccion_f);
		$criteria->compare('telefono_f',$this->telefono_f);
		$criteria->compare('celular_f',$this->celular_f);
		$criteria->compare('parentesco',$this->parentesco);
		$criteria->compare('barrio',$this->barrio);
		$criteria->compare('idPerfil.nombre',$this->id_perfil);
		$criteria->with[]='idPerfil';
                $criteria->addSearchCondition('idPerfil.nombre',$this->id_perfil); 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	function getNombreCompleto()
	{
	    return $this->nombres.' '.$this->apellidos;
	}
}
