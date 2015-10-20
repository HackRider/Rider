<?hh // strict

namespace Rider\Route;

use Rider\Route\URIBuilder;

class RedirectException extends \Exception {
  private URIBuilder $uri_builder;

  public function __construct(URIBuilder $uri_builder): void {
    $this->uri_builder = $uri_builder;
    parent::__construct();
  }

  public function getURI(): string {
    return $this->uri_builder->getURI();
  }
}
