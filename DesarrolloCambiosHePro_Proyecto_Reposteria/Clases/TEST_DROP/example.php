<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>EXAMPLE</h1>
    <div id="myDiv" style="background-color: blue; width: 100px; height: 100px;"></div>
</body>
</html>
<?php // Create a new DOMDocument object 
$doc = new DOMDocument();

// Load the HTML file 
$doc->loadHTMLFile("example.php");

// Get the div element by its id 
$div = $doc->getElementById("myDiv");


// Get the value of the ondrop attribute 
$ondrop = $div->getAttribute("ondrop");
$ondragover = $div->getAttribute("ondragover");
$ondragleave = $div->getAttribute("ondragleave");
$ondragover=function(){
    return false;
};
$ondragleave=function(){
    return false;
};
$ondrop=function($e){
    $e->preventDefault();
    echo "test";
};

// Echo the value of the ondrop attribute 

?>