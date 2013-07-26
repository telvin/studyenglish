<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotPwForm extends CFormModel
{
    public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(

            array('email', 'required'),
            array('email', 'email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{

	}

    public function check_email_exist()
    {
        if(!$this->hasErrors())
        {
            $user_email = User::model()->find('email=:email', array(':email' => $this->email));
            if(empty($user_email))
            {
                $this->addError('email','This email account does not exist in the system. Please check the email address again.');
                return false;
            }

        }
        return true;
    }
}
