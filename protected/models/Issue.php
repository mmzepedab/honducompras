<?php

/**
 * This is the model class for table "tbl_issue".
 *
 * The followings are the available columns in table 'tbl_issue':
 * @property integer $id
 * @property string $ticket_number
 * @property string $category_id
 * @property string $assigned_to
 * @property string $institution_name
 * @property string $contact_number
 * @property string $contact_email
 * @property string $status
 * @property string $create_time
 * @property string $create_user
 * @property string $update_user
 */
class Issue extends CActiveRecord
{
        const STATUS_OPENED = 0;
        const STATUS_CLOSED = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issue the static model class
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
		return 'tbl_issue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('assigned_to, institution_name, contact_number, contact_email, status, category_id', 'required'),
			array('ticket_number, assigned_to, institution_name, contact_number, contact_email, status, create_user, update_user', 'length', 'max'=>255),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ticket_number, assigned_to, institution_name, contact_number, contact_email, status, create_time, create_user, update_user', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO, 'User', 'assigned_to'),
                    'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'category_id' => 'Categoria',
			'ticket_number' => 'Numero de ticket',
			'assigned_to' => 'Asignado a',
			'institution_name' => 'Institucion',
			'contact_number' => 'Telefono',
			'contact_email' => 'Correo',
			'status' => 'Estado',
                        'statusText' => 'Estado',
			'create_time' => 'Hora creado',
			'create_user' => 'Creado por',
			'update_user' => 'Actualizado por',
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
		$criteria->compare('ticket_number',$this->ticket_number,true);
		$criteria->compare('assigned_to',$this->assigned_to,true);
		$criteria->compare('institution_name',$this->institution_name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user,true);
		$criteria->compare('update_user',$this->update_user,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getStatusOptions(){
            return array(               
                self::STATUS_OPENED=>'Abierto',
                self::STATUS_CLOSED=>'Cerrado',
            );            
        }
        
        public function getStatusText(){
            $statusOptions = $this->statusOptions;
            return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : "Sin asignar";
            
        }
        
        public function beforeSave(){
            if(parent::beforeSave())
            {
                if($this->isNewRecord){
                    $this->create_time = Yii::app()->Date->now();
                    $this->create_user = Yii::app()->user->name;
                    //Add oder_number to database 
                    $connection = Yii::app()->db;
                    $command = "SELECT MAX(`order_number`) as order_number FROM tbl_issue WHERE MONTH(`create_time`) = MONTH(CURDATE());"; 
                    $row=$connection->createCommand($command)->queryRow();
                    $this->order_number = (isset($row['order_number']) ? $row['order_number'] : 0) + 1;
                    
                    //Add Ticket Numbet to database
                    $this->ticket_number = date("m")."-".date("y")."-".str_pad(((isset($row['order_number']) ? $row['order_number'] : 0) + 1), 4, "0", STR_PAD_LEFT); 
                }else{                    
                    $this->update_user = Yii::app()->user->name;
                }
                return true;
            }else
                return false;
            
        }
        
        
        
        public function getUsers()
        {
                $criteria=new CDbCriteria;
                $criteria->select='id,first_name,last_name'; 

                $models = User::model()->findAll($criteria);
 
                $list = CHtml::listData($models, 'id', 'concatened');
                
                return $list;
        }
        
        public function getCategories()
        {
                $criteria=new CDbCriteria;
                $criteria->select='id,name'; 

                $models = Category::model()->findAll($criteria);
 
                $list = CHtml::listData($models, 'id', 'name');
                
                return $list;
        }
        
        public function getCategory($id){
            $criteria=new CDbCriteria;
            $criteria->select='name'; 
            $criteria->condition = "id=$id";
            $row = Category::model()->find($criteria); 
            return ($row['name']);
            
        }
        
}