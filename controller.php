<?php
/**
 * @author Artjom Kurapov
 * @since 23.11.13 1:35
 */
namespace OGB;
class Controller{
	protected $models;

	public function useStorage(&$adapter){
		$this->db = $adapter;
	}


	/**
	 * @param $model_name
	 *
	 * @return mixed
	 */
	public function 	load_model($model_name){
		if(!isset($this->models[$model_name])){
			require_once 'model/'.$model_name.'.php';

			$className = '\OGB\Model\\'.ucfirst($model_name);
			$this->models[$model_name]    = new $className();
			$this->models[$model_name]->name = $model_name;

			if(is_subclass_of($this->models[$model_name], 'OGB\Storage\Sqlite3GenericModel')){
				$this->models[$model_name]->useStorage($this->db);
			}

		}

		return $this->models[$model_name];
	}


	private $data=array();
	public function view($controller, $method){
		extract($this->data);

		chdir('view/' . $controller . '/');
		include 'view/' . $controller . '/' . $method . '.php';
	}

	public function assign($var, $value){
		$this->data[$var]=$value;
	}

	public function redirect($url){
		header('Location: '.$url);
	}
}
