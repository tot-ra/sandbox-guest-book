<?php
/**
 * @author Artjom Kurapov
 * @since 28.11.13 17:51
 * @property \OGB\Model\Person $object
 */
class PersonModelTest extends PHPUnit_Framework_TestCase{
	protected $object;

	/** construct */
	public function setUp() {
//		$this->getMock('\OGB\Storage\SelfInstallableModel');
		require_once '../../storage/selfinstallablemodel.php';
		$this->getMock('\OGB\Storage\Sqlite3GenericModel');
		require_once '../../model/person.php';
		$this->object = new \OGB\Model\Person();
	}


	/**
	 * @test
	 */
	public function validateEmail_Empty(){
		$this->assertFalse($this->object->validateEmail(''));
	}


	/**
	 * @test
	 */
	public function validateEmail_NoAt(){
		$this->assertFalse($this->object->validateEmail('sdpfoskdf.spdofkspdfok.wergopekwr.com'));
	}


	/**
	 * @test
	 */
	public function validateEmail_VeryLong(){
		$this->assertFalse($this->object->validateEmail(str_pad('',255,'a')));
	}


	/**
	 * @test
	 */
	public function validateEmail_InvalidNonExistentDomain(){
		$this->assertFalse($this->object->validateEmail('ufo@outerspacegalaxy3888.com'));
	}

	/**
	 * @test
	 */
	public function validateEmail_ValidInternational(){
		$this->assertFalse($this->object->validateEmail('президент@кремль.рф'));
	}

	/**
	 * @test
	 */
	public function validateEmail_Valid(){
		$this->assertTrue($this->object->validateEmail('artkurapov@gmail.com'));
	}


	/**
	 * @test
	 */
	public function validatePassword_TooShort(){
		$this->assertFalse($this->object->validatePassword('12345'));
	}

	/**
	 * @test
	 */
	public function validatePassword_Valid(){
		$this->assertTrue($this->object->validatePassword('123456'));
	}

}
