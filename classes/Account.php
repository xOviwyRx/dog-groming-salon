<?php

namespace classes;

class Account
{
	private $id;
	private $name;
	private $authenticated;
        private $is_admin;
	
	public function __construct()
	{
		$this->id = NULL;
		$this->name = NULL;
		$this->authenticated = FALSE;
                $this->is_admin = FALSE;
	}
	
	public function __destruct()
	{
		
	}
        
        public function addAccount(string $name, string $passwd, Database $db): int
        {

            $name = trim($name);
            $passwd = trim($passwd);

            if (!$this->isNameValid($name))
            {
                    throw new \Exception('Invalid user name');
            }

            if (!$this->isPasswdValid($passwd))
            {
                    throw new \Exception('Invalid password');
            }

            if (!is_null($this->getIdFromName($name, $db)))
            {
                    throw new \Exception('User name not available');
            }
            
            $query = 'INSERT INTO salon.accounts (account_name, account_passwd) VALUES (:name, :passwd)';
            $hash = password_hash($passwd, PASSWORD_DEFAULT);

            $values = array(':name' => $name, ':passwd' => $hash);
            
            $account_id = $db->insertPrepared($query, $values);
            return $account_id;
           
        }
        
        public function isNameValid(string $name): bool
        {
            $valid = TRUE;
            $len = mb_strlen($name);

            if (($len < 8) || ($len > 16))
            {
                    $valid = FALSE;
            }

            return $valid;
        }
        
        public function isPasswdValid(string $passwd): bool
        {
            $valid = TRUE;

            $len = mb_strlen($passwd);
            if (($len < 8) || ($len > 16))
            {
                    $valid = FALSE;
            }

            return $valid;
        }
        
        public function getIdFromName(string $name, Database $db)
        {
            if (!$this->isNameValid($name))
            {
                    throw new \Exception('Invalid user name');
            }

            $id = NULL;

            $query = 'SELECT account_id FROM salon.accounts WHERE (account_name = :name)';
            $values = array(':name' => $name);
            
            $row = $db->fetchPrepared($query, $values);

            if (is_array($row))
            {
                    $id = intval($row['account_id'], 10);
            }

            return $id;
        }
        
        public function login(string $name, string $passwd, Database $db): bool
        {
            $name = trim($name);
            $passwd = trim($passwd);

            if (!$this->isNameValid($name))
            {
                    return FALSE;
            }

            if (!$this->isPasswdValid($passwd))
            {
                    return FALSE;
            }

            $query = 'SELECT * FROM salon.accounts WHERE (account_name = :name) AND (account_enabled = 1)';
            $values = array(':name' => $name);
            $row = $db->fetchPrepared($query, $values);    

            if (is_array($row))
            {
                    if (password_verify($passwd, $row['account_passwd']))
                    {
                            $this->id = intval($row['account_id'], 10);
                            $this->name = $name;
                            $this->authenticated = TRUE;
                            $this->is_admin = filter_var($row['is_admin'], FILTER_VALIDATE_BOOLEAN);
                            $this->registerLoginSession($db);

                            return TRUE;
                    }
            }

            return FALSE;
        }
        
        private function registerLoginSession(Database $db)
        {
            
            if (session_status() == PHP_SESSION_ACTIVE)
            {
                    $query = 'REPLACE INTO salon.account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
                    $values = array(':sid' => session_id(), ':accountId' => $this->id);
                    $db->executePrepared($query, $values);
            }
        }
        
        public function sessionLogin(Database $db): bool
        {
            if (session_status() == PHP_SESSION_ACTIVE)
            {
                    $query = 

                    'SELECT * FROM salon.account_sessions, myschema.accounts WHERE (account_sessions.session_id = :sid) ' . 
                    'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
                    'AND (accounts.account_enabled = 1)';

                    $values = array(':sid' => session_id());
                    $row = $db->fetchPrepared($query, $values); 
                    if (is_array($row))
                    {
                            $this->id = intval($row['account_id'], 10);
                            $this->name = $row['account_name'];
                            $this->authenticated = TRUE;

                            return TRUE;
                    }
            }
            return FALSE;
        }
        
        public function logout(Database $db)
        {
            if (is_null($this->id))
            {
                    return;
            }
            $this->id = NULL;
            $this->name = NULL;
            $this->authenticated = FALSE;

            if (session_status() == PHP_SESSION_ACTIVE)
            {
                    $query = 'DELETE FROM myschema.account_sessions WHERE (session_id = :sid)';
                    $values = array(':sid' => session_id());
                    $db->executePrepared($query, $values);
            }
        }
        public function isAuthenticated(): bool
        {
            return $this->authenticated;
        }
        
        public function isAdmin(): bool
        {
            $this->is_admin;
        }

}


