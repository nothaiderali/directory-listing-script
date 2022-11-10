<!--Directory-Listing-Script-v1.2-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" content="width=device-width" name="viewport">
<style>
html{
  -webkit-text-size-adjust: 100%;
}
body{
  margin: 1.4rem;
}
audio, video, img{
  width: 19.2rem;
  margin: 1rem auto 1rem 0rem;
  border: 4px dotted #ccc;
}
a, b{
  word-wrap: break-word;
}
a:link{
  text-decoration: none;
}
</style>
</head>
<body>
<?php
error_reporting(0);

$maindir = ".";
$maindirl = strlen($maindir);
$dir = $maindir;
$files = [];
$folders = [];
$media = $_GET["media"];
$dark = $_GET["dark"];

if ($media !== "1")
$media = "0";
if ($dark !== "0")
$dark = "1";

if ($_GET and array_key_exists("path", $_GET)){
$dir = $maindir.$_GET["path"];
}

if ($opendirectory = opendir($dir)){

echo "<b>Index&nbsp;of&nbsp;".substr($dir, $maindirl)."</b><br>
";

if ($dir !== $maindir){

$pdir = substr($dir, 0,  strrpos($dir, '/'));

$pdir = substr($pdir, $maindirl);

echo "<b>↩&nbsp;</b><a class='folders' href='?dark=".$dark."&media=".$media."&path=".$pdir."'>Parent Directory</a><br>
";
}

while (($list = readdir($opendirectory)) !== false){

if ($list !== "." and $list !== ".."){

if (is_dir($dir."/".$list)){

array_push($folders,"<a class='folders' href='?dark=".$dark."&media=".$media."&path=".substr($dir, $maindirl)."/".$list."'>".$list."</a><br>
");

}
else{

if ($media == "1")
{

$ext = strtolower(strrchr($list, '.'));

if ($ext == ".jpg" or $ext == ".jpeg" or $ext == ".png" or $ext == ".webp" or $ext == ".gif" or $ext == ".svg")
{
$file = "
<img src='".$dir."/".$list."'><br>
";
}
else if ($ext == ".mp3" or $ext == ".m4a" or $ext == ".wav" or $ext == ".ogg" or $ext == ".aac")
{
$file = "
<audio controls>
<source src='".$dir."/".$list."' type='audio/mp3'>
Your browser does not support the audio tag.
</audio><br>
";
}
else if ($ext == ".mp4" or $ext == ".mkv" or $ext == ".mov" or $ext == ".webm")
{
$file = "
<video controls>
<source src='".$dir."/".$list."' type='video/mp4'>
Your browser does not support the video tag.
</video><br>
";
}

}

array_push($files,"<a class='files' href='".$dir."/".$list."'>".$list."</a><br>
".$file);

}
}
}

natcasesort($folders);
foreach ($folders as $folder) {
echo "<b>•&nbsp;</b>".$folder;
}

natcasesort($files);
foreach ($files as $file) {
echo "<b>•&nbsp;</b>".$file;
}

}
else{
echo "<b>Directory does not exist.<b>";
}

if ($dark == "0")
echo "<style>
body{
  background-color: white;
}
b{
  color: black;
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
";
else
echo "<style>
body{
  background-color: #1f1f1f;
}
b{
  color: #f1f3f4;
}
a.folders:link {
  color: #23bcf1;
}
a.folders:visited {
  color: #23bcf1;
}
a.files:link {
  color: #f6bb25;
}
a.files:visited {
  color: #f6bb25;
}
</style>
";
?>
<!--
</body>
</html>