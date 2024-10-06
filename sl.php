<?php

/**
 * sl.php v0.1
 * 
 * Opiniated SQLite3 wrapper library.
 */

class Sl
{
  // Change $db_file to your own SQLite3 file path.
  static $db_file = 'db.sqlite';

  private static $db;

  private function __construct() {}

  static function getInstance()
  {
    if (!isset(self::$db)) {
      self::$db = new SQLite3(self::$db_file, SQLITE3_OPEN_READWRITE);
    }

    return self::$db;
  }

  static function get(string $query, array $params = [])
  {
    $stmt = self::prep($query, $params);

    $result = $stmt->execute();
    $data = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
      $data[] = (object) $row;
    }
    $result->finalize();

    return $data;
  }

  static function one(string $query, array $params = [])
  {
    $stmt = self::prep($query, $params);

    $result = $stmt->execute();
    $data = (object) $result->fetchArray(SQLITE3_ASSOC);
    $result->finalize();

    return $data;
  }

  static function save(string $table, array $values)
  {
    $db = self::getInstance();
    $columns = array_keys($values);
    $bind = [];
    foreach ($columns as $column) {
      $bind[] = ':' . $column;
    }

    $query = 'INSERT INTO ' . $table . ' (' . implode(',', $columns) . ') VALUES (' . implode(',', $bind) . ')';

    $stmt = self::prep($query, $values);
    $stmt->execute();

    return $db->lastInsertRowID();
  }

  static function update(string $table, array $wheres, array $values)
  {
    $db = self::getInstance();
    $columns = array_keys($values);
    $sets = [];
    $cond = [];

    foreach ($columns as $column) {
      $sets[] = $column . '=:' . $column;
    }

    $where_columns = array_keys($wheres);
    foreach ($where_columns as $where_column) {
      $cond[] = $where_column . '=:' . $where_column;
    }

    $query = 'UPDATE ' . $table . ' SET ' . implode(',', $sets) . ' WHERE ' . implode(' AND ', $cond);

    $stmt = self::prep($query, array_merge($values, $wheres));
    $stmt->execute();
  }

  static function prep(string $query, array $params)
  {
    $db = self::getInstance();

    $stmt = $db->prepare($query);

    foreach ($params as $column => $param) {
      if (mb_substr($column, 0, 1) !== ':') {
        $column = ':' . $column;
      }

      $stmt->bindValue($column, $param);
    }

    return $stmt;
  }
}
