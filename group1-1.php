<?php
/*
I Jay Patel, 000881881 certify that this material is my original work. No other person's work has been used without suitable acknowledgment and I have not made my work available to anyone else.
@author Jay Patel
@version 202335.00
@package COMP 10260 Assignment 1
*/

$serial_number = $_GET['serial_number']; 

$number = substr($serial_number, 3); // To remove first 3 chars
$number = strval($number); // Convert the number to a string
$length = strlen($number); // Calculate the length of the string
//echo $number;
//echo $length;
$output = []; // Initialize an array to store the output

// Function to check for patterns in the serial number
// @return An array describing the pattern 
function checkNum($number, $length){

    $isRadar = isRadarnote($number, $length);
    $isBinary = isBinaryNote($number, $length);
    $isRotator = isRotatorNote($number, $length);
    $isLadder = isLadderNote($number, $length);

    // Add returned string from the functions to the output array if condition is matched
    if ($isRadar !== false) {
        $output[] = $isRadar;
    }
    if ($isBinary !== false) {
        $output[] = $isBinary;
    }
    if ($isLadder !== false){
        $output[] = $isLadder; 
    }
    if ($isRotator !== false) {
        $output[] = $isRotator;
    } 
    elseif (empty($output)){
        $output[] = "Uninteresting serial number";
    }
    return $output; 
}

// Function to check for Solid or Palindrome Note pattern
// @return A string describing the Palindrome pattern or Solid
function isRadarnote($number, $length){

    $isSolid = true;
    $firstDigit = $number[0];

    for ($i = 1; $i < $length; $i++)  {
        if ($number[$i] !== $firstDigit) {
            $isSolid = false;
            break;
        }
    }

    if ($isSolid) {
        return "Solid note";
    }

    $reversedStr = strrev($number);

    if ($reversedStr === $number) {
        return "Palindrome note";
    }

    return false;
}

// Function to check for Binary Note pattern
// @return A string describing the Binary pattern
function isBinaryNote($number, $length){
    for ($i = 0; $i < $length; $i++) {
        $temp = $number[$i];
        if ($temp !== '0' && $temp !== '1') {
            return false;
        }
    }
    return "Binary note";
}

// Function to check for different types of Ladder Note pattern
// @return A string describing the Ladder Up or Ladder Down or Ladder Up-Down or Ladder Down-Up pattern
function isLadderNote($number, $length){
    $isLadderUp = true;
    $isLadderDown = true;
    $isLadderUpDown = true;
    $isLadderDownUp = true;

    // Check if the number is a Ladder Down
    for ($i = 1; $i < $length; $i++) {
        if ($number[$i] != $number[$i - 1] + 1) {
            $isLadderUp = false;
            $isLadderUpDown = false;
            $isLadderDownUp = false;
        }
    }

    // Check if the number is a Ladder Up
    for ($i = 1; $i < $length; $i++) {
        if ($number[$i] != $number[$i - 1] - 1) {
            $isLadderDown = false;
            $isLadderUpDown = false;
            $isLadderDownUp = false;
        }
    }
    
    $midPosition = (int)(($length / 2) - 0.5);  // Index of middle of the string from 0

    // Check if the number is a Ladder Up-Down
    $isLadderUpLeft = true; // Ladder Up on the left side of mid position
    $isLadderDownRight = true; // Ladder Down on the Right side of mid position

    for ($i = 1; $i < $midPosition; $i++) {
        if ($number[$i-1] + 1 != $number[$i]) {
            $isLadderUpLeft = false;
            break;
        }
        else {
            $isLadderUpLeft = true;
        }
    }
    
    for ($i = $midPosition + 1; $i < $length; $i++) {
        if ($number[$i - 1] -1 != $number[$i] ) {
            $isLadderDownRight = false;
            break;
        }
        else {
            $isLadderDownRight = true;
        }
    }

    $isLadderUpDown = $isLadderUpLeft && $isLadderDownRight;

    // Check if the number is a Ladder Down-Up
    $isLadderDownLeft = true; // Ladder Down on the left side of mid position
    $isLadderUpRight = true; // Ladder Up on the right side of mid position

    for ($i = 1; $i < $midPosition; $i++) {
        if ($number[$i - 1] -1 != $number[$i]) {
            $isLadderDownLeft = false;
            break;
        }
        else {
            $isLadderDownLeft = true;
        }
    }

    for ($i = $midPosition + 1; $i < $length; $i++) {
        if ($number[$i-1] + 1 != $number[$i]) {
            $isLadderUpRight = false;
            break;
        }
        else {
            $isLadderUpRight = true;
        }
    }
    
    $isLadderDownUp = $isLadderUpRight && $isLadderDownLeft;

    if ($isLadderUp !== false){
        return "Ladder Up";
    }
    if ($isLadderDown !== false){
        return "Ladder Down";
    }
    if ($isLadderUpDown !== false){
        return "Ladder Up-Down";
    }
    if ($isLadderDownUp !== false){
        return "Ladder Down-Up";
    }
    else{
        return false;
    }

}

// Function to check for Rotator Note pattern
// @return A string describing the Rotator pattern
function isRotatorNote($number, $length){

    $rotatedDigits = [
        '0' => '0',
        '1' => '1',
        '6' => '9',
        '8' => '8',
        '9' => '6',
    ];

    $myNumber = '';

    for ($i = $length - 1; $i >= 0; $i--) {
        if (!isset($rotatedDigits[$number[$i]])) {
            return false;
        }
        $myNumber .= $rotatedDigits[$number[$i]];
    }

    if ($number === $myNumber) {
        return "Rotator note";
    }
}


// Call the checkNum function to check for patterns
$finalOutput = checkNum($number, $length);

// Prints finalOutput array 
foreach ($finalOutput as $a) {
    if ($a === null || $a === false) {
        continue;
    }
    echo "<li>$a</li>";
}

?>

