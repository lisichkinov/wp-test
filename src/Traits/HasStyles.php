<?php

namespace Lisi4\Hello\Traits;

trait HasStyles
{
  protected function registerStyle(string $handle, string $src, array $deps = [])
  {
    if (!filter_var($src, FILTER_VALIDATE_URL)) {
      $url = LISI4_HELLO_RESOURCES_URL . '/css/' . $src;
    } else {
      $url = $src;
    }
    wp_register_style($handle, $url, $deps, LISI4_HELLO_VERSION);
    return $this;
  }

  protected function addStyle(string $handle)
  {
    wp_enqueue_style($handle);
    return $this;
  }
}
