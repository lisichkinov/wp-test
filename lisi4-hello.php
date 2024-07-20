<?php
/*
  Plugin Name: Lisi4 Hello
  Description: Hello world WP plugin
  Version: 1.0.1
  Author: Lisi4
  Text Domain: lisi4-hello
 */

if (!defined('ABSPATH')) {
  exit;
}

require_once dirname(__FILE__) . '/vendor/autoload.php';

define('LISI4_HELLO_VERSION', '1.0.1');
define('LISI4_HELLO_VIEWS_DIR', __DIR__ . '/resources/views/');
define('LISI4_HELLO_RESOURCES_URL', plugins_url('/resources/', __FILE__));

register_activation_hook(__FILE__, ['Lisi4\Hello\Plugin', 'activate']);

register_deactivation_hook(__FILE__, ['Lisi4\Hello\Plugin', 'deactivate']);

add_action('plugins_loaded', function () {
  (new Lisi4\Hello\Plugin())->run();
});
