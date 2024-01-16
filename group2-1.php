<?php

/*
I Jay Patel, 000881881 certify that this material is my original work. No other person's work has been used without suitable acknowledgment and I have not made my work available to anyone else.
@author Jay Patel
@version 202335.00
@package COMP 10260 Assignment 1
*/

$rows = $_GET['rows'];

// Function to draw table
function drawTabel($rows){
?>
<table>
    <?php
    // Loop to generate table rows
    for ($i = 1; $i <= $rows; $i++) {
    ?>
        <tr>
            <td>
                <?php
                // Loop to print numbers in the first cell
                for ($j = 0; $j < $i; $j++) {
                    echo $i;
                }
                ?>
            </td>
            <td>
                <?php
                // Loop to print numbers in the second cell
                echo $i * $i;
                ?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<?php
}

$myTable = drawTabel($rows);
echo $myTable;
?>