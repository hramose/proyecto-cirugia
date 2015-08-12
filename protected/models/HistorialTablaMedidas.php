<?php

/**
 * This is the model class for table "historial_tabla_medidas".
 *
 * The followings are the available columns in table 'historial_tabla_medidas':
 * @property integer $id
 * @property integer $cita_id
 * @property integer $paciente_id
 * @property integer $personal_id
 * @property string $imc
 * @property string $peso
 * @property string $busto
 * @property string $contorno
 * @property string $cintura
 * @property string $umbilical
 * @property string $abd_inferior
 * @property string $abd_superior
 * @property string $cadera
 * @property string $piernas
 * @property string $muslo_derecho
 * @property string $muslo_izquierdo
 * @property string $brazo_derecho
 * @property string $brazo_izquierdo
 * @property string $fecha
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Citas $cita
 * @property Paciente $paciente
 * @property Personal $personal
 */
class HistorialTablaMedidas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_tabla_medidas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('cita_id, paciente_id, personal_id', 'numerical', 'integerOnly'=>true),
			array('imc, peso, busto, contorno, cintura, umbilical, abd_inferior, abd_superior, cadera, piernas, muslo_derecho, muslo_izquierdo, brazo_derecho, brazo_izquierdo', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cita_id, paciente_id, personal_id, imc, peso, busto, contorno, cintura, umbilical, abd_inferior, abd_superior, cadera, piernas, muslo_derecho, muslo_izquierdo, brazo_derecho, brazo_izquierdo, fecha, observaciones', 'safe', 'on'=>'search'),
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
			'cita' => array(self::BELONGS_TO, 'Citas', 'cita_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
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
			'cita_id' => 'Cita',
			'paciente_id' => 'Paciente',
			'personal_id' => 'Personal',
			'imc' => 'IMC',
			'peso' => 'Peso',
			'busto' => 'Busto',
			'contorno' => 'Contorno',
			'cintura' => 'Cintura',
			'umbilical' => 'Umbilical',
			'abd_inferior' => 'ABD Inferior',
			'abd_superior' => 'ABD Superior',
			'cadera' => 'Cadera',
			'piernas' => 'Piernas',
			'muslo_derecho' => 'Muslo Derecho',
			'muslo_izquierdo' => 'Muslo Izquierdo',
			'brazo_derecho' => 'Brazo Derecho',
			'brazo_izquierdo' => 'Brazo Izquierdo',
			'fecha' => 'Fecha',
			'observaciones' => 'Observaciones',
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
		$criteria->compare('cita_id',$this->cita_id);
		$criteria->compare('paciente_id',$this->paciente_id);
		$criteria->compare('personal_id',$this->personal_id);
		$criteria->compare('imc',$this->imc,true);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('busto',$this->busto,true);
		$criteria->compare('contorno',$this->contorno,true);
		$criteria->compare('cintura',$this->cintura,true);
		$criteria->compare('umbilical',$this->umbilical,true);
		$criteria->compare('abd_inferior',$this->abd_inferior,true);
		$criteria->compare('abd_superior',$this->abd_superior,true);
		$criteria->compare('cadera',$this->cadera,true);
		$criteria->compare('piernas',$this->piernas,true);
		$criteria->compare('muslo_derecho',$this->muslo_derecho,true);
		$criteria->compare('muslo_izquierdo',$this->muslo_izquierdo,true);
		$criteria->compare('brazo_derecho',$this->brazo_derecho,true);
		$criteria->compare('brazo_izquierdo',$this->brazo_izquierdo,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialTablaMedidas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
