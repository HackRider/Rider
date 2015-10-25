<?hh // strict

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
