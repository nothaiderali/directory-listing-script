<!--Directory-Listing-Script-v1.1-->
<html>
<head>
<meta charset="utf-8" content="width=device-width" name="viewport">
<style>
html{
  -webkit-text-size-adjust: 100%;
}
a.folders:link {
  color: blue;
}
a.folders:visited {
  color: blue;
  //color: darkblue;
}
a.files:link {
  color: orangered;
}
a.files:visited {
  color: orangered;
  //color: #8c2600;
}
</style>
</head>
<body>
<?php
error_reporting(0);

$maindir = ".";
$maindirl = strlen($maindir);
$dir = $maindir;
$files = "";

if ($_GET and array_key_exists("path", $_GET)){
$dir = $maindir.$_GET["path"];
}

if ($opendirectory = opendir($dir)){

echo "<b>Index of ".substr($dir, $maindirl)."</b><br>
";

if ($dir !== $maindir){

$pdir = substr($dir, 0,  strrpos($dir, '/'));

$pdir = substr($pdir, $maindirl);

echo "<a class='folders' href='?path=".$pdir."'>Parent Directory</a><br>
";
}

while (($list = readdir($opendirectory)) !== false){

if ($list !== "." and $list !== ".."){

if (is_dir($dir."/".$list)){

echo "<a class='folders' href='?path=".substr($dir, $maindirl)."/".$list."'>".$list."</a><br>
";

}
else{

$files = $files."<a class='files' href='".$dir."/".$list."'>".$list."</a><br>
";

}
}
}
echo $files;
}
else{
die("<b>Directory does not exist.<b>");
}
?>
<!--
</body>
</html>