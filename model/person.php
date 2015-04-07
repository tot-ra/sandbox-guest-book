<?php
namespace OGB\Model;

/**
 * Class Person
 * @package OGB\Model
 *
 * @property \PDO $db
 */
class Person extends \OGB\Storage\Sqlite3GenericModel {
	protected $db;


	public function useStorage(&$adapter) {
		$this->db = $adapter;
	}

	public function findByEmail($email) {
		/**
		 * @var \PDOStatement $statement
		 * @var \PDOStatement $result
		 */
		$statement = $this->db->prepare("SELECT * FROM `person` WHERE email LIKE :email LIMIT 1;");
		$statement->bindValue(':email', $email);
		$statement->execute();
		$result = $statement->fetchObject();
		if(!$result){
			return false;
		}
		return (array)$result;
	}


	public function validateEmail($email) {
		if(strlen(trim($email)) < 5) {
			return false;
		}

		//RFC 3696
		if(strlen(trim($email)) > 254) {
			return false;
		}

		$arrEmail = explode('@', $email);
		if(count($arrEmail) != 2) {
			return false;
		}

		$domain = $arrEmail[1];

		if(function_exists('gethostbyname')) {
			if(!filter_var(gethostbyname($domain), FILTER_VALIDATE_IP)) {
				return false;
			}
		}

		return true;
	}


	public function validatePassword($password) {
		return strlen(trim($password)) >= 6;
	}

}