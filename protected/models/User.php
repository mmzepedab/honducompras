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
 * @property string $password_repeat
 */
class User extends CActiveRecord
{
        public $password_repeat; 
        public $temp_password; //When updating to validate if the password was changed
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
			array('first_name, last_name, username, email, is_help_desk', 'required', 'on'=>'insert, update'),
                        array('password_hash, password_repeat', 'required', 'on'=>'insert'),
			array('first_name, last_name, username, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name', 'safe', 'on'=>'search'),
                        array('password_repeat', 'compare', 'compareAttribute'=>'password_hash', 'message'=>"Las contraseñas no coinciden." , 'on'=>'insert'),
                        array('password_repeat , password_hash', 'safe'),
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
                    'issues'=> array(self::HAS_MANY, 'tbl_issue', 'assigned_to'),
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
                        'password_repeat' => 'Repetir Contraseña',
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
        
        /*
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
         * 
         */
        
        public function getHelpDeskUsers(){
            $users = User::model()->findAll();
            $usersArr = Chtml::listData($users, 'id', 'concatened');
            return $usersArr;
        }
        
        public function getConcatened()
        {
                return $this->first_name.' '.$this->last_name;
        }
        
        protected function beforeSave()
        {
            if ($this->isNewRecord){
                $this->password_hash = crypt($this->password_hash, self::blowfishSalt());
            }/*else{
                //echo $this->password_hash.'</br>';
                //echo $this->temp_password.'</br>';
                //echo crypt($this->password_hash, $this->temp_password).'</br>';
                if($this->temp_password === crypt($this->password_hash, $this->temp_password)  ){
                    //echo "Verdadero".'</br>';
                    $this->password_hash = $this->temp_password;                    
                }else{
                    //echo "Falso".'</br>';
                    $this->password_hash = crypt($this->password_hash, self::blowfishSalt());
                }                
            }*/
            return parent::beforeSave();
        }
        
        public function afterFind()
        {
            //reset the password to null because we don't want the hash to be shown.
            $this->temp_password = $this->password_hash;
            //$this->password_hash = null;

            parent::afterFind();
        }
        
        /**
         * Generate a random salt in the crypt(3) standard Blowfish format.
         *
         * @param int $cost Cost parameter from 4 to 31.
         *
         * @throws Exception on invalid cost parameter.
         * @return string A Blowfish hash salt for use in PHP's crypt()
         */
        function blowfishSalt($cost = 13)
        {
            if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
                throw new Exception("cost parameter must be between 4 and 31");
            }
            $rand = array();
            for ($i = 0; $i < 8; $i += 1) {
                $rand[] = pack('S', mt_rand(0, 0xffff));
            }
            $rand[] = substr(microtime(), 2, 6);
            $rand = sha1(implode('', $rand), true);
            $salt = '$2a$' . sprintf('%02d', $cost) . '$';
            $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
            return $salt;
        }
        
        
        
        
}