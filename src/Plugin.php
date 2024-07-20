<?php

namespace Lisi4\Hello;

class Plugin
{
  public function __construct()
  {
    add_action('init', function () {
      load_plugin_textdomain('lisi4-hello', false, dirname(plugin_basename(__FILE__)) . '/languages');
    });
  }

  static public function activate()
  {
    if (!current_user_can('activate_plugins')) {
      return;
    }

    if (version_compare(PHP_VERSION, '7.0.0', '<')) {
      wp_die(sprintf('PHP 7.0.0 or greater is required. Current version is %s', PHP_VERSION));
    }
  }
  static public function deactivate()
  {
    if (!current_user_can('activate_plugins')) {
      return;
    }
  }

  public function run()
  {
    if (!is_admin()) {
      new Shortcodes\Hello();
    }

    new Posttypes\Quiz();
  }
}
