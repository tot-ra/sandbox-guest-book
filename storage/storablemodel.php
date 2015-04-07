<?php
/**
 * @author Artjom Kurapov
 * @since 20.11.13 14:20
 */
namespace OGB\Storage;
interface StorableModel{
	public function useStorage(&$adapter);
	public function index();

	public function insert($tableName);
	public function update($ID);
	public function delete($ID);
}
