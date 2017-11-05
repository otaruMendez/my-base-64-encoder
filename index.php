<?php 

$base64StringMap = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";

$base64StringMapArray = str_split($base64StringMap);

$inputString = "Man is distinguished, not only by his reason, but by this singular passion from
other animals, which is a lust of the mind, that by a perseverance of delight
in the continued and indefatigable generation of knowledge, exceeds the short
vehemence of any carnal pleasure.";

$inputStringArray = str_split($inputString);

$inputStringBits = "";

$inputStringLength = count($inputStringArray);

for ($i = 0; $i < $inputStringLength; $i++) {
  $stringInBits = decbin(ord($inputStringArray[$i]));
  $inputStringBits .= str_pad($stringInBits,8,"0",STR_PAD_LEFT);
}

$offset = 0;
$length = 6;
$noOfIterations = ceil(strlen($inputStringBits)/$length);

$base64EncodedString = "";


for ($i = 0; $i < $noOfIterations; $i++) {
  $base64EncodedString .= $base64StringMapArray[bindec(substr($inputStringBits, $offset, $length))];
  $offset += $length;
}

echo $base64EncodedString;

