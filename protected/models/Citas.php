<?php

/**
 * This is the model class for table "citas".
 *
 * The followings are the available columns in table 'citas':
 * @property integer $id
 * @property integer $paciente_id
 * @property integer $personal_id
 * @property integer $paciente_orden_id
 * @property integer $linea_servicio_id
 * @property string $estado
 * @property string $fecha_cita
 * @property integer $hora_inicio
 * @property integer $hora_fin
 * @property string $correo
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property HorasServicio $horaFin
 * @property Paciente $paciente
 * @property Personal $personal
 * @property PacienteOrden $pacienteOrden
 * @property LineaServicio $lineaServicio
 * @property HorasServicio $horaInicio
 */
class Citas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $nombre_paciente;
	public $apellido_paciente;
	public $cedula_paciente;

	public function tableName()
	{
		return 'citas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, personal_id, linea_servicio_id, estado, fecha_cita, hora_inicio, hora_fin, correo, comentario', 'required'),
			array('paciente_id, personal_id, paciente_orden_id, linea_servicio_id, hora_inicio, hora_fin_mostrar, hora_fin', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>10),
			array('correo', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paciente_id, personal_id, usuario_id, nombre_paciente, cedula_paciente, apellido_paciente, fecha_creacion, fecha_hora_creacion, usuario_estado_id, paciente_orden_id, confirmacion, fecha_confirmacion, fecha_accion, motivo_cancelacion, n_identificacion, contrato_id, equipo_adicional, linea_servicio_id, estado, fecha_cita, hora_inicio, hora_fin, correo, comentario, omitir_seguimiento, actualizacion', 'safe', 'on'=>'search'),
			array('hora_inicio','validarHora'),
			array('hora_fin','validarHoraMenor'),
			array('hora_fin','validarHoraFin'),
			//array('hora_inicio','validarHoraAm'),
			array('fecha_cita','validarFecha'),
			array('fecha_cita','validarHora'),
			
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
			'horaFin' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'personal' => array(self::BELONGS_TO, 'Personal', 'personal_id'),
			'usuario' => array(self::BELONGS_TO, 'Personal', 'usuario_id'),
			'usuarioEstado' => array(self::BELONGS_TO, 'Personal', 'usuario_estado_id'),
			'pacienteOrden' => array(self::BELONGS_TO, 'PacienteOrden', 'paciente_orden_id'),
			'lineaServicio' => array(self::BELONGS_TO, 'LineaServicio', 'linea_servicio_id'),
			'equipoAdicional' => array(self::BELONGS_TO, 'Equipos', 'equipo_adicional'),
			'horaInicio' => array(self::BELONGS_TO, 'HorasServicio', 'hora_inicio'),
			'horaFin' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin'),
			'horaFinMostrar' => array(self::BELONGS_TO, 'HorasServicio', 'hora_fin_mostrar'),
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'contrato_id'),
			'confirmado'=> array(self::BELONGS_TO, 'Personal', 'confirmacion_personal_id'),
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
			'personal_id' => 'Personal',
			'usuario_id' => 'Registrado por',
			'paciente_orden_id' => 'Orden Asociada',
			'linea_servicio_id' => 'Linea de Servicio',
			'estado' => 'Estado',
			'fecha_cita' => 'Fecha de Cita',
			'hora_inicio' => 'Hora de Inicio',
			'hora_fin' => 'Hora de Fin',
			'hora_fin_mostrar' => 'Hora de Fin',
			'correo' => 'Enviar Correo',
			'comentario' => 'Comentario',
			'contrato_id' => 'Contrato Asociado',
			'motivo_cancelacion' => 'Motivo de Cancelación',
			'n_identificacion' => 'Cedula',
			'fecha_accion' => 'Fecha de Acción',
			'usuario_estado_id' => 'Establecio Estado',
			'fecha_confirmacion' => 'Fecha de Confirmación',
			'confirmacion' => 'Comentarios de Confirmación',
			'omitir_seguimiento' => 'Omitir Seguimiento',
			'fecha_creacion' => 'Fecha Creación',
			'fecha_hora_creacion' => 'Fecha y Hora de Creación',
			'actualizacion' => 'Comentario de Actualización',

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
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('usuario_estado_id',$this->usuario_estado_id);
		$criteria->compare('paciente_orden_id',$this->paciente_orden_id);
		$criteria->compare('linea_servicio_id',$this->linea_servicio_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('t.n_identificacion',$this->n_identificacion,true);
		$criteria->compare('DATE_FORMAT(fecha_cita, \'%d-%m-%Y\')',$this->fecha_cita,true);
		$criteria->compare('DATE_FORMAT(fecha_creacion, \'%d-%m-%Y\')',$this->fecha_creacion,true);
		$criteria->compare('hora_inicio',$this->hora_inicio);
		$criteria->compare('hora_fin',$this->hora_fin);
		$criteria->compare('hora_fin_mostrar',$this->hora_fin_mostrar);
		$criteria->compare('contrato_id',$this->contrato_id);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('fecha_accion',$this->fecha_accion,true);
		//$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_hora_creacion',$this->fecha_hora_creacion,true);
		$criteria->compare('fecha_confirmacion',$this->fecha_confirmacion,true);
		$criteria->compare('confirmacion',$this->confirmacion,true);
		$criteria->compare('omitir_seguimiento',$this->omitir_seguimiento,true);
		$criteria->with = array('paciente');
		$criteria->compare('paciente.nombre', $this->nombre_paciente, true );
		$criteria->compare('paciente.apellido', $this->apellido_paciente, true );
		$criteria->compare('paciente.n_identificacion', $this->cedula_paciente, true );
		//$criteria->addCondition('DATE_FORMAT(fecha_cita, \'%d-%m-%Y\') = ' . $this->fecha_cita);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
			'sort'=>array(
			    'defaultOrder'=>'fecha_cita DESC, hora_inicio ASC',
			    'attributes'=>array(
			),
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Citas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validarHora($attribute,$params)
	{
		$lafecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$this->fecha_cita);
		$fechaCita = Citas::model()->findAll("fecha_cita = '$lafecha' and personal_id = '$this->personal_id' and estado != 'Cancelada'");
		
		if(count($fechaCita) > 0)
		{
			foreach ($fechaCita as $fecha_cita)
			{
				if ($this->hora_inicio >= $fecha_cita->hora_inicio and $this->hora_inicio <= $fecha_cita->hora_fin)
				{
					if($this->paciente_id != $fecha_cita->paciente_id)
					{
						$this->addError('hora_inicio', "Ya hay paciente a esta Hora");
					}
				}
			}
		}

		//Validar uso de equipo
		$equiposDisponibles = Equipos::model()->findAll("linea_servicio_id = $this->linea_servicio_id and estado = 'Activo'");
		if ($equiposDisponibles) 
		{
			$agendaEquipos = CitasEquipo::model()->findAll("fecha = '$lafecha' and linea_servicio_id = $this->linea_servicio_id");
			if ($agendaEquipos) 
			{
				//Verificar si hay mas de un equipo
				if (count($equiposDisponibles) > 1) 
				{
					$numero_reservas = count($equiposDisponibles);
					$numero_reservas_comparar = 0;
					foreach ($agendaEquipos as $agenda_equipos) 
					{
						if ($this->hora_inicio >= $agenda_equipos->hora_inicio and $this->hora_inicio <= $agenda_equipos->hora_fin)
						{
							$numero_reservas_comparar = $numero_reservas_comparar + 1;
						}

						if ($numero_reservas == $numero_reservas_comparar)
						{
							$this->addError('hora_inicio', "No hay equipo disponible a esta Hora");
						}
					}
				}
				else
				{
					//Es solo un equipo
					foreach ($agendaEquipos as $agenda_equipos) 
					{
						if ($this->hora_inicio >= $agenda_equipos->hora_inicio and $this->hora_inicio <= $agenda_equipos->hora_fin and $this->id != $agenda_equipos->cita_id)
						{
							$this->addError('hora_inicio', "El equipo esta reservado a esta Hora");
						}	
					}
				}
			}

		}
	}

	public function validarHoraMenor($attribute,$params)
	{
		if ($this->hora_fin <= $this->hora_inicio) 
		{
			$this->addError('hora_fin', "No puede ser inferior a hora de inicio");
		}
	}

	public function validarHoraAm($attribute,$params)
	{
		if($this->fecha_cita == date("Y-m-d"))
		{
			$lahora = HorasServicio::model()->find("id = '$this->hora_inicio'");
			if (strtotime($lahora->hora) < strtotime(date('h:ia'))) 
			{
				$this->addError('hora_inicio', "No puede ser inferior a hora actual - ".date('h:ia'));
			}
		}
		
	}

	public function validarHoraFin($attribute,$params)
	{
		$lafecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$this->fecha_cita);
		$fechaCita = Citas::model()->findAll("fecha_cita = '$lafecha' and personal_id = '$this->personal_id' and estado != 'Cancelada'");
		
		if(count($fechaCita) > 0)
		{
			foreach ($fechaCita as $fecha_cita)
			{
				if ($this->hora_fin >= $fecha_cita->hora_inicio and $this->hora_inicio <= $fecha_cita->hora_fin) 
				{
					if($this->paciente_id != $fecha_cita->paciente_id)
					{
						$this->addError('hora_fin', "Ya hay paciente a esta Hora");
					}
				}
			}
		}

		//Validar uso de equipo
		$equiposDisponibles = Equipos::model()->findAll("linea_servicio_id = $this->linea_servicio_id and estado = 'Activo'");
		if ($equiposDisponibles) 
		{

			$agendaEquipos = CitasEquipo::model()->findAll("fecha = '$lafecha' and linea_servicio_id = $this->linea_servicio_id");
			if ($agendaEquipos) 
			{
				//Verificar si hay mas de un equipo
				if (count($equiposDisponibles) > 1) 
				{
					$numero_reservas = count($equiposDisponibles);
					$numero_reservas_comparar = 0;
					foreach ($agendaEquipos as $agenda_equipos) 
					{
						if ($this->hora_fin >= $agenda_equipos->hora_inicio and $this->hora_inicio <= $agenda_equipos->hora_fin) 
						{
							$numero_reservas_comparar = $numero_reservas_comparar + 1;
						}

						if ($numero_reservas == $numero_reservas_comparar)
						{
							$this->addError('hora_fin', "No hay equipo disponible a esta Hora");
						}
					}
				}
				else
				{
					//Es solo un equipo
					foreach ($agendaEquipos as $agenda_equipos) 
					{
						if ($this->hora_fin >= $agenda_equipos->hora_inicio and $this->hora_inicio <= $agenda_equipos->hora_fin and $this->id != $agenda_equipos->cita_id) 
						{
							$this->addError('hora_fin', "El equipo esta reservado a esta Hora");
						}	
					}
					
				}
			}

		}
	}

	public function validarFecha($attribute,$params)
	{
		$lafecha = Yii::app()->dateformatter->format("dd-MM-yyyy",$this->fecha_cita);
		if (strtotime(date("d-m-Y")) > strtotime($lafecha)) 
		{
			$this->addError('fecha_cita', "La fecha no puede ser antes de hoy ".date("d-m-Y"));
		}
	}
}
