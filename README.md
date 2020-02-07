
# Php CLI console helpers

Helpers for CLI with php

## Message
A simple text message. It can be colorized.

### Common messages
```php
use \Console\Helpers\Message;

Message::info('My message'); // a simple white text
Message::warn('My message'); // yellow text
Message::error('My message'); // red text
Message::success('My message'); // green text
Message::check('My message'); // white text starting with ✓
Message::checkSuccess('My message'); // green text starting with ✓
Message::checkError('My message'); // red text starting with ×
Message::step('My message'); // a white text starting with →
```
### Custom message
```php 
use \Console\Helpers\Message;

$color  =  'light_purple';
$background  =  'yellow';

Message::custom('My message', $color, $background);
```

### Color list
Color | Text | Background
|-|-|-
white||✓
black|✓|✓
dark_gray|✓
light_gray|✓
blue|✓|✓
light_blue|✓|
cyan|✓|✓
green|✓|✓
light_green|✓
magenta||✓
red|✓|✓
light_red|✓
purple|✓
light_purple|✓
brown|✓
yellow|✓|✓

## StatusBar
A progression bar.
```php
use \Console\Helpers\StatusBar;

$length = 1000;
for ($i = 0; $i < $length; $i++) {
	$params = array(
		'number' => $i + 1,
		'total' => $length
	));
	
	StatusBar::show($params);
}
```
```cli
████████████████████████░░░░░░░ 60%
```

### Parameters list
Parameter | type | values
|-|-|-
number|Integer|The number of element done. Note that in a for beginning from zero, you have to increment by one to get the correct percent value since the percent is calculted as  `$number / $total * 100`
|total|Integer|Number of elements to process
complete|Function|callback to call on progress ends. Has as parameter the total execution time in second.
print|Array of String| List of additionnals elements to show when printing the progress bar. <br/>Values can be : <br />-`percent` : the progression percent<br />-`number` : an indicator for number of elements processed over elements amount <br/>  - `eta` : the number of time before finish (in seconds)


Example
```php
use \Console\Helpers\StatusBar;

$length = 1000;
for ($i = 0; $i < $length; $i++) {
	$params = array(
		'number' => $i + 1,
		'total' => $length,
		'print' => array('percent', 'number', 'eta'),
		'complete' => function($time) {
			echo 'took ' . $time . 's)';
		}
	));
	
	StatusBar::show($params);
}
```
```cli 
██████████████░░░░░░░░░░░░░ 42% | 152 / 350 | ETA : 3s
```