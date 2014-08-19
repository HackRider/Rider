<?hh

class DBResult implemets IteratorAggregate {

  public function __construct(Vector $rows) {
    $this->rows = $rows;
  }

  public function getRows(): Vector {
    return $this->rows;
  }

  public function getFirstRow(): ?mixed {
    if ($this->rows->count() > 0) {
      return $this->rows[0];
    } else {
      return null;
    }
  }

  public function getIterator(): Iterator {
    return $this->rows->getIterator();
  }
}
