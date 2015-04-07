<?php
namespace OGB\Storage;

/**
 * @author Artjom Kurapov
 * @since 23.11.13 2:18
 * @property \PDO $db
 */
class Sqlite3GenericModel implements \OGB\Storage\StorableModel {
	protected $db;
	public $name;


	public function useStorage(&$adapter) {
		$this->db = $adapter;
	}


	protected $joinedTables = array();


	public function with($joinTable) {
		$this->joinedTables[] = $joinTable;
		return $this;
	}

	public function index() {
		$tableName = $this->name;

		$query = "SELECT *, sourceTable.id FROM `$tableName` AS sourceTable ";

		if($this->joinedTables){
			foreach($this->joinedTables as $jtKey => $joinedTable){
				$query.=" LEFT JOIN `$joinedTable` AS t$jtKey ON t$jtKey.id = sourceTable.".$joinedTable."_id ";
			}
		}

		/**
		 * @var \PDOStatement $res
		 */
		$res    = $this->db->query($query);
		$result = array();
		while($row = $res->fetchObject()) {
			$result[] = (array)$row;
		}
		return $result;
	}


	public function insert($entity) {

		$arrEntity = get_object_vars($entity);

		if($arrEntity) {
			$strClassName = get_class($entity);
			$arrClassName = explode('\\', $strClassName);
			$strPureClass = end($arrClassName);
			$strTableName    = strtolower($strPureClass);
			$strKeys         = implode('`,`', array_keys($arrEntity));
			$strPlaceholders = implode(',:', array_keys($arrEntity));
			/**
			 * @var \PDOStatement $statement
			 */
			$query     = "INSERT INTO $strTableName (`$strKeys`) VALUES (:$strPlaceholders);";
			$statement = $this->db->prepare($query);

			foreach($arrEntity as $k => $v) {
				if(is_string($v)) {
					$statement->bindValue(":$k", $v, SQLITE3_TEXT);
				}
				else {
					$statement->bindValue(":$k", $v, SQLITE3_INTEGER);
				}
			}

			$statement->execute();
		}
		else {
			throw new Sqlite3GenericModelException('Attempt to save empty entity');
		}
	}


	public function update($data) {
		//todo
	}


	public function delete($ID) {
		//todo
	}
}

class Sqlite3GenericModelException extends \Exception {

}