<?php
namespace OGB;

/**
 * @author Artjom Kurapov
 * @since 23.11.13 2:00
 * @property \OGB\Storage\Sqlite3GenericModel $model
 */
class Entity {
	public $ID;
	private $model;


	/**
	 * @param \OGB\Storage\Sqlite3GenericModel $model
	 */
	public function __construct($model) {
		$this->model = $model;
	}


	public function save() {
		if(is_null($this->ID)) {
			$this->model->insert($this);
		}
		else {
			$this->model->update($this);
		}
	}
}