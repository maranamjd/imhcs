<?php

  /**
   *
   */
  class Model
  {

    function __construct()
    {
      $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    public function join($table, $key, $condition){
      $tables = [
        [
          "$this->table" => ['*'],
        ],
        [
          "$table" => ['*']
        ]
      ];
      $keys = [
        "$key" => [
            $this->table,
            $table
          ]
      ];
      try {
        return $this->db->join($tables, $keys, $condition);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function save(){
      try {
        return $this->db->insert($this->table, $this->columns);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function count($condition){
      try {
        $result = $this->db->select($this->table, ['*'], $condition);
        return is_array($result) ? count($result) : 0;
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function find($condition){
      try {
        $result = $this->db->select($this->table, ['*'], $condition);
        if (count($result) > 0) {
          return $result[0];
        }else {
          return null;
        }
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function select($columns = ['*'], $condition){
      try {
        return $this->db->select($this->table, $columns, $condition);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function all(){
      try {
        return $this->db->select($this->table, ["*"], "1");
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function delete($condition){
      try {
        return $this->db->delete($this->table, $condition);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function update($columns, $condition){
      try {
        return $this->db->update($this->table, $columns, $condition);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

  }
