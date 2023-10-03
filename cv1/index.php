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

$file = fopen('safe.txt', 'a');

flock($file, LOCK_EX); // Get exclusive lock on file

fwrite($file, "Test\n");
flock($file, LOCK_UN); // Release file lock
fclose($file);

// Store a PHP object as a JSON string
file_put_contents('test.json', json_encode([2, 4, 6]));

// Read JSON string in to a PHP object
$my_array = json_decode(file_get_contents('test.json'));
print_r($my_array);

fwrite(STDOUT, "Hello, world!\n");
fwrite(STDERR, "Hello, error! Enter some text:\n");

$input = fread(STDIN, 1024);
fwrite(STOUT, "Input received: " . $input . "\n");

echo is_dir('/path/to/check');

echo getcwd();

echo __DIR__;

echo __FILE__;

chdir('/path/to/change/to/');
echo getcwd();

mkdir('/path/to/make');

rmdir('/path/to/delete');

$contents = scandir('.');
print_r($contents);
glob()
?>

<?php
// Set the MIME type
header('Content-Type: video/x-msvideo');
// Specify the return file name and that it should be downloaded
header('Content-Disposition: attachment; filename=my_video.avi');

$file = fopen("compress.zlib://my_video.avi.gz", 'r');

// Serve the contents until end of file
while (!feof($file)) {
    echo fread($file, 8192);
};

echo file_get_contents('compress.zlib://my_video.avi.gz');