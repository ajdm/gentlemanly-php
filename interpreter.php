<?php
$options = array();

// Check if there are no arguments
if (sizeof($argv) == 1) {
    die("\nI am terribly sorry, but it appears you have given me nothing to do. To ask me to interpret a file, please use:
        
    php interpreter.php --outfile=output_filename.php input_file.gphp

where --outfile is an optional argument. If you do not wish me to evaluate the instructions, please add --eval=false to your command.\n\n");
}

// Read Gentlemanly PHP
$fileName = $argv[sizeof($argv)-1];
$code = @file_get_contents($fileName);
if ($code == false) die("\nI am terribly sorry, but I cannot read your instructions from the file '$fileName'.\n\n");

// Parse named command-line arguments
foreach ($argv as $arg){
    preg_match('/\-\-(\w*)\=?(.+)?/', $arg, $value);
    if ($value && isset($value[1]) && $value[1])
        $options[$value[1]] = isset($value[2]) ? $value[2] : null;
}

// Allow the user to specify an output file name, or programmatically determine it
$outputFile = isset($options['outfile']) ? $options['outfile'] : str_replace(".gphp", ".php", $fileName);
// Allow the user to switch off evaluation
$eval = $options['eval'] === "false" ? false : true;


// Gentlemanly to actual PHP mappings
$syntax = array(
    "Dear Interpreter," => "<?php",
    "To whom it may concern," => "<?php",
    "£" => "$",
    "I remain, as always, your humble and obedient servant,\n.*" => "?>",
    "Yours sincerely,\n.*" => "?>",
    "Yours faithfully,\n.*" => "?>",

    'Henceforth, \$([a-z,A-Z,0-9]+) is ' => '\$$1 = ',
    'I declare \$([a-z,A-Z,0-9]+) to be ' => '\$$1 = ',

    "Take up thine pen for " => "fopen",
    "Note this down " => "fprintf",
    "Rest thine pen for " => "fclose",


    "Proclaim" => "echo",
    "Announce" => "echo",
    "and move onto the next line" => ' . "\n"',

    'Consider \$([a-z,A-Z,0-9]+)' => 'switch(\$$1)',
    "Perhaps" => "case",
    "Most excellent" => "break",
    "If one may be so bold" => "default",

    "Would you mind" => "try",
    "If you do mind" => "catch",
    "Make a hasty exit" => "die",

    "Now, " => "",
    "Please, " => "",
    "Then, " => "",
    "Also, " => "",
    "And, " => "",
    "And so, " => "",
    "I say, " => "",

    "Twiddle one's thumbs for ([0-9]+) seconds" => "sleep($1)",

    'For each \$([a-z,A-Z,0-9]+) in \$([a-z,A-Z,0-9]+) in turn' => 'foreach(\$$2 as \$$1)',

    "Roll a die numbered from ([0-9]+) to ([0-9]+)" => "rand($1, $2)",
    "Roll a die" => "rand()",

    "Perchance" => "if",
    "Or if" => "elseif",
    "Or, failing the above" => "else",

    "Please perform" => "do",
    "Whilst" => "while",

    "Keep calm and carry on" => "continue",

    "Verily" => "true",

    "One must have" => "require",
    "One would be partial to" => "include"
);


// Pull out the author's name
$lastNewline = strrpos($code, "\n");
$name = substr($code, $lastNewline+1);

// Convert Gentlemanly PHP to actual PHP
foreach($syntax as $gentlemanly => $php){
    $code = preg_replace("/" . $gentlemanly . "/i", $php, $code);
}

// Transcribe code into actual PHP and save
$fileHandle = @fopen($outputFile, 'w') or die("\nI apologise most profusely, $name, but I must report that I cannot write to the file '" . $outputFile . "'!\n\n");
fwrite($fileHandle, $code);
fclose($fileHandle);

// Evaluate the code, as long as the user has requested not to
if ($eval) {
echo "
Dear $name,

I have evaluated your instructions from '$fileName' and report that the output produced is:

";

$evalCode = $code;
// Add comment marks to opening and closing tags so that eval() works correctly
$evalCode = str_ireplace("<?php", "/*<?php*/", $evalCode);
$evalCode = str_ireplace("?>", "/*?>*/", $evalCode);
eval($evalCode);

echo "

Yours sincerely,
The Interpreter

P.S. I have also transcribed a less civilised version of your instructions into '" . $outputFile . "', lest you require the services of one of my more backwards cousins.\n\n";
}

?>