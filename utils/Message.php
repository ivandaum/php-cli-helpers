<?php
namespace Console\Utils;

class Message {
  private static function time() {
    return '[' . date('G:i:s') . '] ';
  }

  public static function text($message = ' ', $color = null, $background = null) {
    return Colors::getColoredString($message, $color, $background) . PHP_EOL;
  }

  public static function info($message) {
    echo self::text($message);
  }

  public static function warn($message) {
    echo self::text($message, 'yellow');
  }

  public static function error($message) {
    echo self::text($message, 'red');
  }

  public static function success($message) {
    echo self::text($message, 'green');
  }

  public static function check($message, $color = 'green') {
    echo self::text('✓ ' . $message);
  }

  public static function checkSuccess($message) {
    echo self::text('✓ ' . $message, 'green');
  }

  public static function checkError($message) {
    echo self::text('× ' . $message, 'red');
  }

  public static function step($message) {
    echo self::text('→ ' . $message);
  }

  public static function custom($message, $color = null, $background = null) {
    echo self::text($message, $color);
  }
}