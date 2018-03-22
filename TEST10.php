<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example 11
  // lets draw something else ;)
  //
  // http://de.wikipedia.org/wiki/Kuboktaeder
  // http://en.wikipedia.org/wiki/Cuboctahedron
  //

  $m = matrixIdentity(4);
  $m = matrixMultiMatrix($m, matrixHexaProjectionReal());
  $m = matrixMultiMatrix($m, matrixScale(array(10,10,10)));
  $m = matrixMultiMatrix($m, matrixYawPitchRoll(deg2rad(80), deg2rad(45), deg2rad(140)));
  $zeroP = array(0,0,0);
  echo '<body bgcolor="#000"><div style="margin-left:500px;margin-top:300px;">';
  for($x=-20; $x<=20; $x++)
  {
    for($y=-20; $y<=20; $y++)
    {
      for($z=-20; $z<=20; $z++)
      {
        $hexaPoint = array($x, $y, $z, 1);
        if (distanceHexaFields($zeroP, $hexaPoint) > 15) continue;
        if (distanceHexaFields($zeroP, $hexaPoint) < 10) continue;
        $screenPoint = vectorMultiMatrix($hexaPoint, $m);
        $col = dechex((255 / 300 * ($screenPoint[2]+150)));
        if (strlen($col)==1) $col = '0'.$col;
        echo '<div style="z-index:'.((int)$screenPoint[2]).';width:6px;height:6px;background:#00'.$col.'00;position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;"></div>';
      }
    }
  }
  echo '</div></body>';
