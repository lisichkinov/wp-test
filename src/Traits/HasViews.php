<?php

namespace Lisi4\Hello\Traits;

trait HasViews
{
  protected function render(string $view, array $data = [])
  {
    $file_path = LISI4_HELLO_VIEWS_DIR . "/$view.php";

    if (file_exists($file_path)) {
      extract($data);
      ob_start();
      require $file_path;
      $contents = ob_get_contents();
      ob_end_clean();
    } else {
      throw new \Exception("File '$file_path' doesn't exist!");
    }

    return $contents;
  }
}
