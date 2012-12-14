<!DOCTYPE html>
<html>
<head>
<title>This is where the Lexer fails miserably.</title>
</head>
<body>
<?php
include('PostLexer.class.php');

echo "<h1>Terminals used:</h1>\n";
echo "<pre>\n";
print_r(PostLexer::get_terms());
echo "</pre>\n";

$tests = array(
    'This is a regular comment. There is nothing fancy about it.',
    '(code) if(true) { echo "dongs"; } (code)',
    'This is (italic cool) text.',
    'This is a (bold neato) addition to the lexer.',
    'This is a regular comment, except with a quote. (quote 123)',
    "This cites an article. (cite \"u're mum's a fag xdd\" dinmor.dk)",
    "This also cites stuff. (cite 'i caem @ ure butt :))' bbc.co.uk)",
    'This is (code)(print "dongs")(code) inline code.'
);

foreach($tests as $test) {
    echo '<h2>' . $test . '</h2>' . "\n";
    echo "<pre>\n";
    $lex = PostLexer::run(array($test));
    print_r($lex);
    echo "</pre>\n";
    echo "<h3>This is the HTML:</h3>\n";
    echo PostLexer::parseString($test);
    echo "<hr />\n";
}
?>
</body>
</html>
