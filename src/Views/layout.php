<?hh // strict

namespace Rider\Views;

final class :layout extends :x:element {
  children (:xhp);

  final protected function render(): XHPRoot {
    return
      <html>
        <body>
          {$this->getChildren()}
        </body>
      </html>;
  }
}
