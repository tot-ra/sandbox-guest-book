<?php
/**
 * @author Artjom Kurapov
 * @since 20.11.13 13:34
 */

namespace OGB\Controller;
use OGB\Controller;

class User extends Controller {

	const passwordSalt = 'we93mg9sl2knrt30';


	public function register() {
		/**
		 * @var \OGB\Model\Person $personModel
		 * @var \OGB\Model\Usersession $usersession
		 */
		$personModel = $this->load_model('person');
		$usersession = $this->load_model('usersession');

		if($_POST) {
			if(!$personModel->validateEmail($_POST['email'])) {
				$this->assign('errors', array('Please enter valid email'));
			}
			elseif(!$personModel->validatePassword($_POST['password'])) {
				$this->assign('errors', array('Please enter password at least 6 characters long'));
			}
			elseif($personModel->findByEmail($_POST['email'])) {
				$this->assign('errors', array('User is already registered'));
			}
			else {
				$person             = new \OGB\Entity\Person($personModel);
				$person->first_name = $_POST['first_name'];
				$person->last_name  = $_POST['last_name'];
				$person->email      = $_POST['email'];
				$person->password   = sha1($_POST['password'] . self::passwordSalt);
				$person->save();

				$exUser = $personModel->findByEmail($person->email);
				$usersession->setUserSession($exUser);
				$this->redirect('?c=guestbook&m=index');
			}
		}

		$this->view('user', 'register');
	}


	public function login() {
		/**
		 * @var \OGB\Model\Person $personModel
		 * @var \OGB\Model\Usersession $usersession
		 */
		$personModel = $this->load_model('person');
		$usersession = $this->load_model('usersession');

		if($_POST) {
			$exUser = $personModel->findByEmail($_POST['email']);

			if(!isset($_POST['password']) || !$personModel->validatePassword($_POST['password'])) {
				$this->assign('errors', array('Please enter password at least 6 characters long'));
			}
			elseif($exUser && $exUser['password'] == sha1($_POST['password'] . self::passwordSalt)) {
				$usersession->setUserSession($exUser);
				$this->redirect('?c=guestbook&m=index');
			}
			else{
				$this->assign('errors', array('Invalid login, password or not user registered'));
			}
		}
		$this->view('user', 'login');
	}


	public function logout() {
		/**
		 * @var \OGB\Model\Usersession $usersession
		 */
		$usersession = $this->load_model('usersession');
		$usersession->unsetUserSession();
		$this->redirect('?c=guestbook&m=index');
	}
}
