<?php

/**
 * This is the model class for table "producto_proveedor".
 *
 * The followings are the available columns in table 'producto_proveedor':
 * @property integer $id
 * @property string $doc_nit
 * @property string $nombre
 * @property string $direccion
 * @property string $ciudad
 * @property string $telefono
 * @property string $nombre_contacto
 * @property string $email_contacto
 * @property string $telefono_contacto
 * @property string $celular_contacto
 */
class ProductoProveedor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto_proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_nit, nombre', 'required'),
			array('doc_nit', 'length', 'max'=>30),
			array('nombre', 'length', 'max'=>75),
			array('ciudad', 'length', 'max'=>25),
			array('telefono, telefono_contacto, celular_contacto', 'length', 'max'=>15),
			array('nombre_contacto, email_contacto', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, doc_nit, nombre, direccion, ciudad, telefono, nombre_contacto, email_contacto, telefono_contacto, celular_contacto', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'doc_nit' => 'Doc / NIT',
			'nombre' => 'Nombre',
			'direccion' => 'Dirección',
			'ciudad' => 'Ciudad',
			'telefono' => 'Telefono',
			'nombre_contacto' => 'Nombre de Contacto',
			'email_contacto' => 'Email de Contacto',
			'telefono_contacto' => 'Teléfono de Contacto',
			'celular_contacto' => 'Celular de Contacto',
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
		$criteria->compare('doc_nit',$this->doc_nit,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('nombre_contacto',$this->nombre_contacto,true);
		$criteria->compare('email_contacto',$this->email_contacto,true);
		$criteria->compare('telefono_contacto',$this->telefono_contacto,true);
		$criteria->compare('celular_contacto',$this->celular_contacto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>20),
		));
	}

	public function suggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'doc_nit LIKE :keyword or nombre LIKE :keyword',
			'order'=>'doc_nit',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
				'label'=>$model->doc_nit.' - '.$model->nombre,  // label for dropdown list
				'value'=>$model->doc_nit,  // value for input field
				'id'=>$model->id,       // return values from autocomplete
				'nombre'=>$model->nombre,
				'direccion'=>$model->direccion,
				'ciudad'=>$model->ciudad,
				'telefono'=>$model->telefono,
				'id_proveedor'=>$model->id,
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
	 * @return ProductoProveedor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
