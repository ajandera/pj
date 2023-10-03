<?php

$file = fopen('hello.txt', "w") or die("Unable to open file!");
fwrite($file, "Hello, world!\n");
fclose($file);

file_put_contents('hello.txt', "Hello, world, again!\n");

$filename = 'test.txt';
$number_of_bytes_to_read = filesize($filename);

$file = fopen($filename, 'r');
$contents = fread($file, $number_of_bytes_to_read);
echo $contents;

$contents = file_get_contents('test.txt');
echo $contents;

$lines = file('test.txt'); // Each line will still have it's line ending character
print_r($lines);

echo filesize('hello.txt');

echo file_exists('hello.txt');

$f = fopen('hello.txt', 'a');

fwrite($file, "Test\n");
fclose($file);

// Store a PHP object as a JSON string
file_put_contents('test.json', json_encode([2, 4, 6]));

// Read JSON string in to a PHP object
$my_array = json_decode(file_get_contents('test.json'));
print_r($my_array);

fwrite($f, "Hello, world!\n");
fwrite($f, "Hello, error! Enter some text:\n");

echo is_dir('./');
echo file_exists('hello.txt');

echo getcwd();

echo __DIR__;

echo __FILE__;

chdir('./');
echo getcwd();

mkdir('./test');

rmdir('./test');

$contents = scandir('.');
print_r($contents);