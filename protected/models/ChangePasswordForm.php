<?php
// models/ChangePasswordForm.php

class ChangePasswordForm extends CFormModel
{
    /**
     * @var string
     */
    public $user_password_hash;

    /**
     * @var string
     */
    public $new_password;

    /**
     * @var string
     */
    public $new_password_repeat;

    /**
     * Validation rules for this form.
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('user_password_hash, new_password, new_password_repeat', 'required'),
            array('user_password_hash', 'validateCurrentPassword', 'message'=>'Esta no es su contraseña actual.'),
            array('new_password', 'compare', 'compareAttribute'=>'new_password_repeat', 'message'=>'Las contraseñas deben coincidir.'),
            //array('new_password , new_password_repeat, user_password_hash', 'safe'),
            //array('newPassword', 'match', 'pattern'=>'/^[a-z0-9_\-]{5,}/i', 'message'=>'Your password does not meet our password complexity policy.'),
        );
    }
    
    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_password_hash' => 'Contraseña anterior',
                        'new_password' => 'Contraseña nueva',
                        'new_password_repeat' => 'Repetir Contraseña nueva',
		);
	}

    /**
     * I don't know your hashing policy, so I assume it's simple MD5 hashing method.
     * 
     * @return string Hashed password
     */
    protected function createPasswordHash($password)
    {
        return crypt($password, self::blowfishSalt());
    }

    /**
     * I don't know how you access user's password as well.
     *
     * @return string
     */
    protected function getUserPassword()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        return $user->password_hash;
    }

    /**
     * Saves the new password.
     */
    public function saveNewPassword()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if($user->updateByPk(Yii::app()->user->id,array('password_hash'=>$this->createPasswordHash($this->new_password)))){            
            return true;
        }else{
            CModel::addError($this->user_password_hash, 'No se pudo actualizar su contraseña');
            return false;
        }
    }

    /**
     * Validates current password.
     *
     * @return bool Is password valid
     */
    public function validateCurrentPassword()
    {
        
        //echo $user->password_hash;
        //return $this->createPasswordHash($this->currentPassword) == $this->getUserPassword();
        
        //echo $this->getUserPassword().'</br>';
        //echo crypt($this->user_password_hash, $this->getUserPassword()).'</br>';
        //echo $this->user_password_hash;
        
        
            
        if($this->getUserPassword() != crypt($this->user_password_hash, $this->getUserPassword())  ){
            CModel::addError($this->user_password_hash, 'La contraseña anterior no coincide con la almacena. Favor verificar.');
            return false;
        }
        
        //if(crypt($this->new_password, $this->getUserPassword()) != $this->getUserPassword()){
            //CModel::addError($this->password_hash, 'La contraseña anterior no coincide con la almacena. Favor verificar.');
            //return false;
        //}
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