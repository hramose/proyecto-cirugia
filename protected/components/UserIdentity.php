<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
public $userType = 'Front';
	 
	public function authenticate()
    {
        if($this->userType=='Front') // This is front login
        {
            // check if login details exists in database
                        $record=Usuarios::model()->findByAttributes(array('usuario'=>$this->username)); 
            if($record===null)
            { 
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            else if($record->clave!==$this->password)            // here I compare db password with password field
            { 
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {  
                $this->setState('usuarioId',$record->personal_id);
                $this->setState('usuario',$record->usuario);
                $this->setState('name', $record->personal->nombreCompleto);
                $this->setState('citas', $record->personal->agenda);
                $this->setState('perfil', $record->perfil_sistema_id);		
				
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
    }
}