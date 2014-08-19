<?hh

class DB {
  public static function query(string $db, string $query): DBResult {
    return new DBResult(new Vector());    
  }
}
