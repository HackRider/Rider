<?hh

class Cookie {
  public static function set(
    string $key,
    string $value,
    int $time
  ): void {
    setcookie($key, $value, $time);
  }

  public static function remove(
    string $key
  ): void {
    if (isset($_COOKIE[$key])) {
      setcookie($key, null, -1, '/');
      unset($_COOKIE[$key]);
    }
  }
}
