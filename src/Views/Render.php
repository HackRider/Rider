<?hh // strict

namespace Rider\Views;

use Rider\Controller\BaseController;
use XHPRoot;

class Render {
  public static function go(BaseController $controller, string $method): void {
    $content = call_user_func(array($controller, $method));
    if (is_object($content) && is_a($content, \XHPRoot::class)) {
      self::renderXHP($content, $controller);
    } else if ((is_array($content)) ||
               (is_object($content) && is_a($content, Map::class))) {
      self::renderJSON($content);
    }
  }

  private static function renderXHP(
    XHPRoot $content,
    BaseController $controller,
  ): void {
    $title = $controller::getConfig()->getTitle();
    print
      <layout title={$title}>
        {$content}
      </layout>
    ;
  }

  private static function renderJSON(mixed $content): void {
    header('Content-Type: application/json');
    print json_encode($content, JSON_PRETTY_PRINT);
  }
}
