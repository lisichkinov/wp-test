<?php

namespace Lisi4\Hello\Shortcodes;

use Lisi4\Hello\Traits\{
  HasStyles,
  HasScripts,
  HasViews
};

class Hello
{
  use HasViews, HasScripts, HasStyles;

  private $handle = 'hello';

  public function __construct()
  {
    add_shortcode($this->handle, [$this, 'getContent']);
  }

  public function getContent($attributes = [], $content = ''): string
  {
    $args = shortcode_atts([
      'id'       => null
    ], $attributes, $this->handle);

    return $this->render('shortcodes/hello', [
      'text' => 'Hello World',
    ]);
  }
}
