<?hh

class Cookie {
  public static function create(
    string $key,
    string $value,
    ?int $time = time()+60*60*24*30
  ): void {
    setcookie($key, $value, $time, '/');
  }

  public static function find(string $key): ?Cookie {
    if (isset($_COOKIE[$key])) {
      return new Cookie($key, $_COOKIE[$key]);
    }
    return null;
  }

  public static function remove(
    string $key
  ): void {
    if (isset($_COOKIE[$key])) {
      setcookie($key, null, -1, '/');
      unset($_COOKIE[$key]);
    }
  }

  private static function __construct(string $key, mixed $value): void {
    $this->key = $key;
    $this->value = $value;
  }

  public function getValue(): mixed {
    return $this->value;
  }

  public function destroy(): void {
    self::remove($this->key);
  }
}
