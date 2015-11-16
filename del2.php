<?php
/* 
CLI usage (requires that PHP be in your PATH):
php del2.php <input filename> <output filename> <delimiter letter to remove> 

None of the arguments need to be surrounded by quotes unless they have a space in them.
Future development may allow for multiple delimiters in a single script-run, but for now it 
needs to be run once for each delimiter to be removed.

Input/output files can be any filetype that is delimited text (.txt, .csv being the primary two).  
You can change the delimiter character below.
*/


require_once('./vendor/autoload.php');

/* 	
	Documentation for League\Csv is available at http://csv.thephpleague.com/
	The library is a wrapper for the native PHP CSV functionality
*/

use League\Csv\Reader as Reader;
use League\Csv\Writer as Writer;



$inputfilename = $argv[1];
$outputfilename = $argv[2];
$delimiter = $argv[3];
// $removePunctuation = $argv[4];	// doesn't currently do anything

$reader = Reader::createFromPath($inputfilename);
$writer = Writer::createFromPath($outputfilename, 'w');

/*
	These two lines determine what character delimits each "field" in the input/output file.
	This could be changed to "," or "|" or any other character.  "Special characters",
	like <tab>, must be within double-quotes.  Special characters include \t (tab), \s (space),
	etc.
*/
$reader->setDelimiter("\t");
$writer->setDelimiter("\t");

$count = 0;
foreach($reader->fetch() as $row) {
//	var_dump($row);
	$marc = $row[0];
	$marc = $marc . '|';	// hack to add a delimiter to end of string

	$pattern = "/\|" . $delimiter . ".*(?=[\|])/";
	$newMarc = preg_replace($pattern, '', $marc);
	$cleanMarc = preg_replace('/\|$/', '', $newMarc);

	if(array_key_exists(1, $row)) {
		$rec = $row[1];
	} else {
		$rec = '';
	}

	$newLine = array($cleanMarc, $rec);

	$writer->insertOne($newLine);
	$count++;
}

echo 'File processed!  ' . $count . " delimiters removed.\n";
