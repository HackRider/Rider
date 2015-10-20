<?hh // strict

namespace Rider\Model;

interface ModelSchema {
  public function getFields(): Map<string, ModelField>;
  public function getTableName(): string;
  public function getIdField(): string;
}
