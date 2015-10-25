<?hh // strict

namespace Rider\Views;

use Rider\Controller\BaseController;
use XHPRoot;

class Render {
  public static function go(BaseController $controller, string $method): void {
    $content = null;
    switch($method) {
    case 'GET':
      $content = $controller->get();
      break;
    case 'PUT':
      $content = $controller->put();
      break;
    case 'POST':
      $content = $controller->post();
      break;
    case 'DELETE':
      $content = $controller->delete();
      break;
    }

    if (!$content) {
      return;
    }

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
      </layout>;
  }

  private static function renderJSON(mixed $content): void {
    header('Content-Type: application/json');
    print json_encode($content, JSON_PRETTY_PRINT);
  }
}
