<?php

/**
 * This is the model class for table "tbl_question".
 *
 * The followings are the available columns in table 'tbl_question':
 * @property integer $id
 * @property string $title
 * @property string $answer
 * @property string $create_time
 * @property string $create_user
 * @property string $update_user
 * @property string $department_id
 */
class Question extends CActiveRecord
{
        const DEPT_OTHER = 0;
        const DEPT_CONVENIO_MARCO = 1;
        const DEPT_CCORPO = 2;
        const DEPT_LEGAL = 3;
        const DEPT_REGISTRO_PROVEEDORES = 4;
        const DEPT_MESA_AYUDA = 5;
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, answer, department_id', 'required'),
                        array('department_id', 'numerical', 'integerOnly'=>true),
			array('title, create_user, update_user', 'length', 'max'=>255),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, answer, create_time, create_user, update_user', 'safe', 'on'=>'search'),
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
			'title' => 'Pregunta',
			'answer' => 'Respuesta',
			'create_time' => 'Hora Creado',
			'create_user' => 'Creado por',
			'update_user' => 'Actualizado por',
                        'department_id' => 'Departamento',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user,true);
		$criteria->compare('update_user',$this->update_user,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getDeptOptions(){
            $categories = Category::model()->findAll();
            $categoriesArr = Chtml::listData($categories, 'id', 'name');
            return $categoriesArr;
            
        }
        
        public function getDeptText(){
            $deptOptions = $this->deptOptions;
            return isset($deptOptions[$this->department_id]) ? $deptOptions[$this->department_id] : "Sin asignar";
            
        }
        
        public function beforeSave(){
            if(parent::beforeSave())
            {
                if($this->isNewRecord){
                    $this->create_time = Yii::app()->Date->now();
                    $this->create_user = Yii::app()->user->name;
                }else{                    
                    $this->update_user = Yii::app()->user->name;
                }
                return true;
            }else
                return false;
            
        }
}