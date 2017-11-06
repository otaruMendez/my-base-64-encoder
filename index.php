<?php 

$base64StringMap = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
$base64StringMapArray = str_split($base64StringMap);

$inputString = "Man is distinguished, not only by his reason, but by this singular passion from
other animals, which is a lust of the mind, that by a perseverance of delight
in the continued and indefatigable generation of knowledge, exceeds the short
vehemence of any carnal pleasure";

$inputStringArray = str_split($inputString);
$inputStringLength = count($inputStringArray);
$inputStringBits = "";

for ($i = 0; $i < $inputStringLength; $i++) {
  $stringInBits = decbin(ord($inputStringArray[$i]));
  $inputStringBits .= str_pad($stringInBits,8,"0",STR_PAD_LEFT);
}

$offset = 0;
$length = 6;
$noOfIterations = ceil(strlen($inputStringBits)/$length);
$padZeros =  strlen($inputStringBits) + (6 - strlen($inputStringBits)%$length);
$base64EncodedString = "";

if ($padZeros > 0) {
  $inputStringBits = str_pad($inputStringBits,$padZeros,"0",STR_PAD_RIGHT);
}

for ($i = 0; $i < $noOfIterations; $i++) {
  $base64EncodedString .= $base64StringMapArray[bindec(substr($inputStringBits, $offset, $length))];
  $offset += $length;
}

$inputStringLastBitsBlockLength = strlen($inputStringBits) % 24;

if ($inputStringLastBitsBlockLength == 18) {
  $base64EncodedString .= "=";
} else if ($inputStringLastBitsBlockLength == 12) {
  $base64EncodedString .= "==";
}

echo $base64EncodedString;

