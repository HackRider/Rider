<?hh

namespace Rider\Route;

class Router {
  public static function dispatch(string $path, string $method): void {

    // Get the auto-generated URI Map
    $routes = URIMap::getURIMap();

    // Match the path
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    foreach ($routes as $route_path => $controller_name) {
      if (preg_match("@^$route_path$@i", "$uri", $_SESSION['route_params'])) {
        $controller = (new ReflectionClass($controller_name))->newInstance();
        invariant(
          $controller instanceof \Rider\Controller\BaseController,
          "Tried to instanciate a controller which does not extend BaseController",
        );

        Auth::runChecks($controller->getConfig()->getChecks());

        try {
          Render::go($controller, $method);
        } catch (RedirectException $ex) {
          header('Location: '.$ex->getURI());
          exit();
        }

        return;
      }
    }
  }
}
