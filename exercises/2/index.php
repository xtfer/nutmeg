<?php
/**
 * Example exercise 2 for Nutmeg.
 *
 * This shows you how to set up a more advanced PHP exercise, and the use of
 * HTML in output.
 */

$cities = array(
  0 => array('Tokyo', 'Japan', 'Asia'),
  1 => array('Mexico City', 'Mexico', 'North America'),
  2 => array('New York City', 'USA', 'North America'),
  3 => array('Mumbai', 'India', 'Asia'),
);

$output = '';

foreach ($cities as $city) {
  $row = '';

  foreach ($city as $item) {
    $row .= '<td>' . $item . '</td>';
  }

  $output .= '<tr>' . $row . '</tr>';
}

?>


<table>
  <thead>
  <th>City</th>
  <th>Country</th>
  <th>Continent</th>
  <thead>

  <?php print $output; ?>

</table>