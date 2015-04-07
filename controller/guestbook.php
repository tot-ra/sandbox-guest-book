<?php

namespace OGB\Controller;

use OGB\Controller;

class Guestbook extends Controller {
	public function index() {
//		$person = $this->load_model('person');
		$message = $this->load_model('message');

		/**
		 * @var \OGB\Model\Message $message
		 */

		$message_list = $message->with('person')->index();

		$this->assign('message_list', $message_list);
		$this->view('guestbook', 'index');
	}


	public function add_post() {
		/**
		 * @var \OGB\Model\Person $personModel
		 * @var \OGB\Model\Usersession $usersession
		 */
		$messageModel = $this->load_model('message');
		$usersession  = $this->load_model('usersession');

		$message            = new \OGB\Entity\Message($messageModel);
		$message->text      = $_POST['text'];
		$message->created   = time();
		$message->person_id = $usersession->getUserID();
		$message->save();

		$this->redirect('?c=guestbook&m=index');
	}
}