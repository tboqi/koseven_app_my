<?php
class Model_Base extends Model_Database {
	
	protected $table;
	
	function find_all($fields = '*') {
		$arr = array();
		
		$sql = "select {$fields} from `{$this->table}`";
		$query = DB::query(Database::SELECT, $sql);
		$results = $query->as_object()->execute();
		
		foreach ($results as $row){
			$arr[] = $row;
		}
		return $arr;
	}
	
	function count() {
		$total = DB::select(array('COUNT("id")', 'num'))
		->from($this->table)->execute()->get('num', 0);
		return $total;
	}
	
	function insert(array $data) {
		$fields = array();
		$values = array();
		foreach ($data as $field => $value) {
			$fields[] = $field;
			$values[] = $value;
		}
		$insert = DB::insert($this->table)->columns($fields)->values($values);
 
		list($insert_id, $affected_rows) = $insert->execute();
		return $insert_id;
	}
	
	function get($id, $fields = '*') {
		$query = DB::select($fields)->from($this->table)->where('id', '=', $id);
		$results = $query->execute();
		return $results->current();
	}
	
	function update(array $array, $id) {
		$update_rows = DB::update($this->table)->set($array)
		->where('id', '=', $id)->execute();
		return $update_rows;
	}
	
	function del($id) {
		$delete_rows = DB::delete($this->table)
		->where('id', '=', $id)->execute();
		return $delete_rows;
	}
	
	function find($limit, $start, $fields='*') {
		$arr = array();
		
		$sql = "select {$fields} from {$this->table} order by id desc limit :start, :limit";
		$query = DB::query(Database::SELECT, $sql);
		$query->param(':start', $start);
		$query->param(':limit', $limit);
		$results = $query->execute();
        return $results->as_array();
	}
}