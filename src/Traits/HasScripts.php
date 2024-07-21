<?php

namespace Lisi4\Hello\Traits;

trait HasScripts
{
  protected function registerScript(string $handle, string $src, array $deps = [])
  {
    if (!filter_var($src, FILTER_VALIDATE_URL)) {
      $url = LISI4_HELLO_RESOURCES_URL . 'js/' . $src;
    } else {
      $url = $src;
    }
    wp_register_script($handle, $url, $deps, LISI4_HELLO_VERSION, 'all');
    return $this;
  }

  protected function addScript(string $handle)
  {
    wp_enqueue_script($handle);
    return $this;
  }

  protected function localizeScript(string $handle, string $name, array $args = [])
  {
    wp_localize_script($handle, $name, $args);
    return $this;
  }
}
