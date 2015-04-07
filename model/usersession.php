<?php
namespace OGB\Model;
class UserSession{
	public function isLoggedIn() {
		return isset($_SESSION['user']);
	}


	public function unsetUserSession() {
		unset($_SESSION['user']);
	}


	public function setUserSession($user) {
		$_SESSION['user'] = (array)$user;
	}

	public function getUserID() {
		return isset($_SESSION['user']) ? (int)$_SESSION['user']['id'] : null;
	}
}