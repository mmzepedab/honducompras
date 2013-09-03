<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property integer $is_help_desk
 * @property string $password_hash
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, username, email, password_hash', 'required'),
			array('first_name, last_name, username, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name', 'safe', 'on'=>'search'),
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
                        'email' => 'Correo electronico',
                        'username' => 'Nombre de usuario',
                        'password_hash' => 'Contraseña',
			'first_name' => 'Nombre',
			'last_name' => 'Apellido',
                        'is_help_desk' => 'Es oficial de Mesa de ayuda',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getHelpDeskUsers(){
            return array(               
                1=>'Mario Zepeda',
                2=>'Marlon Zuniga',
                3=>'Alejandra Fonseca',
                4=>'Manuel Murillo',
                5=>'Wendy Cuellar',                
                6=>'Omar Valladares', 
            );            
        }
        
        public function getConcatened()
        {
                return $this->first_name.' '.$this->last_name;
        }
}