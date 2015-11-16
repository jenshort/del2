#Del^2 (DeleteDelimiters)
This script removes "|<letter>" delimited subfields from text strings.  The intended use is to remove specific subfields from MARC tagged data.

##Requirements
* PHP>=5.4.0 
* PHP extension:  ext-mbstring	(enable in php.ini)
* [Composer](http://getcomposer.org)

##Installation
Download the zip file or clone the repo to your local machine.  Run `composer install` from the project directory to download and install the dependencies.


##CLI usage
```php del2.php <input filename> <output filename> <delimiter letter to remove>``` 

Note: if the directory containing the php executable is not in your path, you will need to prepend the php command above with the appropriate directory.

None of the arguments need to be surrounded by quotes unless they have a space in them.  Future development may allow for multiple delimiters in a single script-run, but for now it needs to be run once for each delimiter to be removed.

Input/output files can be any filetype that is delimited text (.txt, .csv being the primary two). You can change the text file delimiter character in the script if needed.  It defaults to the tab character.