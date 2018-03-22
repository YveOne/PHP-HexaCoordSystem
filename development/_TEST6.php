<?php

  include('HexagonCoordinateSystem_Rev2.php');

  function getAngle($x1, $y1, $x2, $y2)
  {
    return atan2($y2-$y1, $x2-$x1);
  }

  //http://www.dzone.com/snippets/point-inside-polygon
  function isPointInPoly($poly, $pt){
    for($c = false, $i = -1, $l = count($poly), $j = $l - 1; ++$i < $l; $j = $i)
      (($poly[$i][1] <= $pt[1] && $pt[1] < $poly[$j][1]) || ($poly[$j][1] <= $pt[1] && $pt[1] < $poly[$i][1]))
      && ($pt[0] < ($poly[$j][0] - $poly[$i][0]) * ($pt[1] - $poly[$i][1]) / ($poly[$j][1] - $poly[$i][1]) + $poly[$i][0])
      && ($c = !$c);
    return $c;
  }

  $poly = array(
    array(109,4),
    array(250,42),
    array(287,183),
    array(184,287),
    array(42,250),
    array(5,10)
  );

  $p = array(242,265);

  var_dump(isPointInPoly($poly, $p));
