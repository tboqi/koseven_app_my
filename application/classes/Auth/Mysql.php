<?php defined('SYSPATH') OR die('No direct access allowed.');

class Auth_Mysql extends Auth {
	
	private $model_user;
	
	/**
	 * Constructor loads the user list into the class.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->model_user = new Model_User();
	}
	
	/**
	 * Logs a user in.
	 *
	 * @param   string   $account  Username
	 * @param   string   $password  Password
	 * @param   boolean  $remember  Enable autologin (not supported)
	 * @return  boolean
	 */
	protected function _login($account, $password, $remember) {
		if (is_string($password))
		{
			// Create a hashed password
			$password = $this->hash($password);
		}
		
		$user = $this->model_user->getByAccount($account);
		if ($password == $user['password']) {
			// Complete the login
			$this->complete_login($user['id']);
			return $user;
		}
		
		// Login failed
		return FALSE;
	}
	
	public function password($account) {
		$user = $this->model_user->getByAccount($account);
		if ($user) {
			return $user['password'];
		}
		return '';
	}

	public function check_password($password) {
		$username = $this->get_user();
		
		if ($username === FALSE)
		{
			return FALSE;
		}
		
		return ($password === $this->password($username));
	}
	
	protected function complete_login($user_id)
	{
		// Regenerate session_id
		$this->_session->regenerate();
	
		// Store username in session
		$this->_session->set($this->_config['session_key'], $user_id);
	
		return TRUE;
	}
	
}
