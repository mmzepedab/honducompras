<?php

/**
 * This is the model class for table "entidades".
 *
 * The followings are the available columns in table 'entidades':
 * @property integer $codent
 * @property string $nombre
 * @property string $siglas
 * @property integer $codigo_tipo
 * @property string $direccion
 * @property string $telefono
 * @property string $fax
 * @property string $web
 *
 * The followings are the available model relations:
 * @property UnidadesEjecutoras[] $unidadesEjecutorases
 * @property ProcesosMarcados[] $procesosMarcadoses
 */
class Entidades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, siglas, codigo_tipo, direccion, telefono, fax, web', 'required'),
			array('codigo_tipo', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('siglas, telefono, fax', 'length', 'max'=>50),
			array('direccion', 'length', 'max'=>500),
			array('web', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codent, nombre, siglas, codigo_tipo, direccion, telefono, fax, web', 'safe', 'on'=>'search'),
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
			'unidadesEjecutorases' => array(self::HAS_MANY, 'UnidadesEjecutoras', 'codent'),
			'procesosMarcadoses' => array(self::HAS_MANY, 'ProcesosMarcados', 'CodEntidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codent' => 'Codent',
			'nombre' => 'Nombre',
			'siglas' => 'Siglas',
			'codigo_tipo' => 'Codigo Tipo',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'fax' => 'Fax',
			'web' => 'Web',
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

		$criteria->compare('codent',$this->codent);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('siglas',$this->siglas,true);
		$criteria->compare('codigo_tipo',$this->codigo_tipo);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('web',$this->web,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entidades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
