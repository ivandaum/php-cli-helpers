<?php
namespace Console\Helpers;

/**
 * show a status bar in the console
 * 
 * <code>
 * $length = 1000;
 * for ($i = 0; $i < $length; $i++) {
 *	  StatusBar::show(array(
 *			'number' => $i + 1,
 *			'total' => $length,
 *			'print' => array('percent', 'number', 'eta'),
 *			'complete' => function($time) {
 *				  echo 'took ' . $time . 's)';
 *		  }
 *    ));
 * }
 * </code>
 *
 * @param   int     $options   array of settings
 * $options = array(
 *    'number' => Number // current number of elements done
 *    'total' => Number // total number of elements
 *    'print' => Array // visuals feedback to show : ['eta', 'percent', 'number']
 * );
 * @return  void
 *
 */
class StatusBar {
  public static function show($options) {

    $index = (int) $options['number'];
    $length = (int) $options['total'];
    $complete = isset($options['complete']) ? $options['complete'] : null;
    $width = isset($options['width']) ? isset($options['width']) : 30;

    static $startTime;
    if(empty($startTime)) $startTime = time();
    $now = time();

    $percent = $index / $length;

    $progress = ceil($percent * $width);
    $bar = "\r" . str_repeat("█", $progress);

    if ($bar < $width) {
      $bar .= str_repeat("░", $width - $progress);
    }

    if(isset($options['print'])) {
      $print = $options['print'];

      if(in_array('percent', $print)) {
        $bar .= ' ' . floor($percent * 100) . '%';
      }

      if (in_array('number', $print)) {
        $bar .= ' | ' . $index . ' / ' . $length;
      }

      if (in_array('eta', $print) && $index < $length) {
        $rate = ($now - $startTime) / $index;
        $left = $length - $index;
        $eta = round($rate * $left, 2);
        $bar .= ' | ETA : ' . number_format($eta) . 's';
      }
    }

    echo $bar;

    flush();
    if($index >= $length) {
      echo PHP_EOL;
      if(gettype($complete) === 'object') {
        $complete(number_format($now - $startTime));
      }
      $startTime = null;
    }
  }
}