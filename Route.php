<?hh

class Route {
  public static function go(string $path): void {
    if (!array_key_exists($path, URIMap::getURIMap())) {
      return;
    }
    $controllerName = URIMap::getURIMap()[$path];
    $controller = new $controllerName();
    invariant(
      $controller instanceof BaseController,
      "Controller must be an instance of a Base Controller"
    );

    print {$controller->render()}
  }

  public static function redirect(string $path): void {
    http_redirect($path);
  }
}
