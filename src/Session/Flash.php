<?hh

namespace Rider\Session;

class Flash {
  const FLASH = 'flash';

  public static function set($key, $value): void {
    if(!isset($_SESSION[self::FLASH])) {
      $_SESSION[self::FLASH] = Map {};
    }
    $_SESSION[self::FLASH][$key] = $value;
  }

  public static function get($key): mixed {
    if(isset($_SESSION[self::FLASH]) && isset($_SESSION[self::FLASH][$key])) {
      $value = $_SESSION[self::FLASH][$key];
      unset($_SESSION[self::FLASH][$key]);
      return $value;
    }
  }

  public static function exists($key): bool {
    return isset($_SESSION[self::FLASH]) && isset($_SESSION[self::FLASH][$key]);
  }
}
