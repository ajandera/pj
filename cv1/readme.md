# Introduction
## These examples demonstrate how to work with files and directories in PHP including:

- Reading, writing, and appending files
- Getting file size
- Checking if a file exists
- Creating, checking, changing, and removing directories
- Listing directory contents
- Working with JSON
- Searching directories for files
- Reading and writing compressed files
- File open modes
- When opening a file, there are several different modes you can use. The most common ones are r and w for read and write. There are several more available though that will control whether you create a new file, open an existing file, and whether you start writing at the beginning or the end. These modes are used with fopen() in the rest of the examples.

r - read only\
w - write only, force new file\
a - write only with pointer at end\
x - write only, create new file or error on existing\
r+ - read/write, file pointer at beginning\
w+ - read/write, force new file\
a+ - read/write, file pointer at end\
x+ - read/write, create new file or error on existing\

### Write to a file
When writing files you have two primary options that we will look at:

Writing bytes as needed with fwrite()
Writing the entire file contents at once with file_put_contents()
WRITE BYTES

This example shows how to write to a file with some basic text. First, open with fopen() then You can keep writing to the file with fwrite() until you are done, and then call fclose().

    <?php
    $file = fopen('hello.txt', "w") or die("Unable to open file!");
    fwrite($file, "Hello, world!\n");
    fclose($file);

WRITE ENTIRE FILE AT ONCE

This is more convenient and perfect for smaller files that won't exhaust the system RAM.

    <?php
    file_put_contents('hello.txt', "Hello, world, again!\n");

### Read from a file
When reading a file you have the same two primary options that we will look at:

Reading bytes as needed with fread()
Reading the entire file in to a variable with file_get_contents()

READ BYTES

This example will read N number of bytes in to a variable with fread(). In this case, it will read all the bytes based on the length of the file. You could just read one or two bytes at a time. It will return FALSE if it fails. You can check if the end of file has been reached with feof().

    <?php
    $filename = 'test.txt';
    $number_of_bytes_to_read = filesize($filename);

    $file = fopen($filename, 'r');
    $contents = fread($file, $number_of_bytes_to_read);
    echo $contents;

// You can check for EOF with `feof()`
echo feof($file);

READ ENTIRE FILE AT ONCE

This is more memory intensive but convenient. It is best for smaller files that will not exhauset the system RAM.

    <?php

    $contents = file_get_contents('test.txt');
    echo $contents;

READ ALL LINES OF A TEXT FILE

To quickly get an array containing each line of a file, use the file() function.

    <?php

    $lines = file('test.txt'); // Each line will still have it's line ending character
    print_r($lines);

### Common file tasks
Here are some examples of other common tasks I perform with files like:

- Getting file size
- Checking if a file exists
- Check if a file is a directory
- Get a lock on a file
- Read and write JSON

GET FILESIZE

You can quickly get the size of a file in bytes using the filesize() function.

    <?php
    echo filesize('hello.txt');

CHECK IF FILE EXISTS

You can easily check if a file exists with the file_exists() function.

    <?php
    echo file_exists('hello.txt');

GET AN EXCLUSIVE LOCK ON A FILE

This is useful when you want to ensure only one write operation is happening at a time. For example, if you have a file that stores an integer called hit_counter.txt you will want to make sure there is no race condition and that multiple writes are not happening at once.

    <?php
    $file = fopen('safe.txt', 'a');


https://www.php.net/manual/en/function.flock.php

    flock($file, LOCK_EX); // Get exclusive lock on file

Perform read/write actions while holding the lock

    fwrite($file, "Test\n");
    flock($file, LOCK_UN); // Release file lock
    fclose($file);

### WORKING WITH JSON

A common task is to take data from a PHP array and convert it to a JSON string for storage on disk. Then later reading the file with the JSON string and created a PHP array to work with. To learn more about PHP and JSON check out my tutorial, Working with JSON in PHP.

Here is a basic example of reading and writing a JSON file.


    <?php
    // Store a PHP object as a JSON string
    file_put_contents('test.json', json_encode([2, 4, 6]));

    // Read JSON string in to a PHP object
    $my_array = json_decode(file_get_contents('test.json'));
    print_r($my_array);

READING AND WRITING FROM STDIN, STDOUT, AND STDERR

If you want to explicitly work with the standard input, output, and error streams, you can use them with special named constants STDOUT, STDIN, and STDERR.

    <?php
    // test.php
    fwrite(STDOUT, "Hello, world!\n");
    fwrite(STDERR, "Hello, error! Enter some text:\n");

    $input = fread(STDIN, 1024);
    fwrite(STOUT, "Input received: " . $input . "\n");

Then run the file, and enter some text and press enter. Alternatively you can pipe some content in to STDIN like this:

    echo "Testing" | php test.php

CHECK IF FILE IS A DIRECTORY

To check if a directory entry is a file or a directory, you can use is_dir() function.

    <?php

    echo is_dir('/path/to/check');

GET CURRENT WORKING DIRECTORY

You can check what directory you are in with the getcwd() function.

    <?php

    echo getcwd();

GET THE DIRECTORY THAT THE PHP FILE IS IN

This is useful for creating paths relative to the PHP file no matter what the current working directory is.

    <?php

    echo __DIR__;

GET THE PATH OF THE PHP FILE BEING EXECUTED

This is useful for checking what the full path of the PHP file is

    <?php

    echo __FILE__;

CHANGE DIRECTORY

You can easily change directories with the chdir() function.

    <?php

    chdir('/path/to/change/to/');
    echo getcwd();

MAKE DIRECTORY

You can make a directory with mkdir().

    <?php

    mkdir('/path/to/make');

REMOVE DIRECTORY

Similarly, delete a directory with rmdir().

    <?php

    rmdir('/path/to/delete');

GET DIRECTORY CONTENTS

If you want to list the contents of a directory you have two main options:

- scandir() - scandir() will return all contents of a directory
- glob() - glob() lets you search for contents in a directory using a pattern like *.* or *.png

Which one you use will depend on your needs.

scandir()

The scandir() function will list everything in a directory. It will include both files and directories. Contents includes . and .. entries.

    <?php

    $contents = scandir('.');
    print_r($contents);
    glob()

The glob() function lets you search a directory for contents using a pattern. It will return files and directories found.

Some example search patterns you can use are:

- \*
- ./\*
- /path/to/search/*
- \*.\*
- \*.jpg
- log\*

    <?php

    $all_contents = glob("*");
    print_r($all_contents);

    $log_entries = glob("*log*");
    print_r($log_entries);

Using GZip compressed files
PHP has a convenient way to work with compressed files like GZip files. They call them compression wrappers and they make reading and writing compressed files totally seamless. It supports GZip (zlib), BZip2, and Zip compression but I will focus on GZip.

To use the compression wrappers, all you have to do is prefix your file with: compress.zlib://.

For example:

fopen('compress.zlib://myfile.gz', 'r')
You can open a file for reading or writing and work with it as normal. Any time a read or write operation is done, it will automatically compress or uncompress as needed.

This next example shows how you would take a video file that is gzipped (.avi.gz) and return it as the uncompressed .avi. This way, the files are zipped while they are stored on the server, but when the user downloads them they are unzipped.



In this example, there is a video filenamed my_video.avi.gz.

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

If the file is small enough and you have enough RAM, you can simply call file_get_contents() which will load the entire thing in to memory at once.

    echo file_get_contents('compress.zlib://my_video.avi.gz');