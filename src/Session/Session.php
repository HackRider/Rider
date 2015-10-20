<?hh

namespace Rider\Session;

class Session {
  public static function init(): mixed {
    session_start();
  }

  public static function exists(string $key): bool {
    return isset($_SESSION[$key]);
  }

  public static function set(string $key, mixed $value): void {
    $_SESSION[$key] = $value;
  }

  public static function get(string $key): mixed {
    return $_SESSION[$key];
  }
}
