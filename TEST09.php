<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example 10
  // lets draw a rotated ball, WTF!!!!
  // and with some more documentation and explanations
  //

  $m = matrixIdentity(4);
  $m = matrixMultiMatrix($m, matrixScale(array(10,10,10)));
  $m = matrixMultiMatrix($m, matrixHexaProjectionReal());
  $m = matrixMultiMatrix($m, matrixYawPitchRoll(deg2rad(122), deg2rad(25), deg2rad(164)));
  $zeroP = array(0,0,0);
  echo '<body bgcolor="#000"><div style="margin-left:500px;margin-top:300px;">';
  for($x=-20; $x<=20; $x++)
  {
    for($y=-20; $y<=20; $y++)
    {
      for($z=-20; $z<=20; $z++)
      {
        // our hexa point ...
        $hexaPoint = array($x, $y, $z, 1);
        // check distance, because we wanna draw a ball
        if (distanceHexaReal($zeroP, $hexaPoint) > 15) continue;
        // this extracts an inner ball to lower the lag
        if (distanceHexaReal($zeroP, $hexaPoint) < 10) continue;
        // multiplicated with matrix = screen point
        $screenPoint = vectorMultiMatrix($hexaPoint, $m);
        // z is invisible, skip it
        if ($screenPoint[2] < 0) continue;
        // create our color
        $col = dechex((240 / 150 * $screenPoint[2]) +10);
        if (strlen($col)==1) $col = '0'.$col;
        // and draw it
        echo '<div style="z-index:'.((int)$screenPoint[2]).';width:6px;height:6px;background:#00'.$col.'00;position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;"></div>';
      }
    }
  }
  echo '</div></body>';
