<?hh

class AutoLoader {
  private static function getClassMap(): Map<string, string> {
    return Map {
      // Helpers
      'Route' => 'lib/Route.php',
      'Auth' => 'lib/Auth.php',
      'DB' => 'lib/DB.php',

      // DAO
      'User' => 'lib/dao/User.php',
      
      // Controllers
      'BaseController' => 'lib/BaseController.php',
      'HomeController' => 'application/controllers/HomeController.php',
      'LoginController' => 'application/controllers/LoginController.php',

      // XHP
      'xhp_page' => 'application/view/page.php',
      'xhp_page__head' => 'application/view/page_head.php',
      'xhp_page__navbar' => 'application/view/page_navbar.php',
      'xhp_login__modal' => 'application/view/login_modal.php'
    };
  }

  public static function loadFile(string $class): void {
    require_once self::getClassMap()[$class];
  }
}
