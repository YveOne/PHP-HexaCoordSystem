<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example 9
  // How to show a ball with z depth
  // warning: will cause some lag
  //

  $mHexaToScreen = matrixMultiMatrix(matrixScale(array(10,10,10)), matrixHexaProjectionReal());
  $zeroP = array(0,0,0);

  echo '<body bgcolor="#000"><div style="margin-left:500px;margin-top:300px;">';
  for($z=0; $z<=20; $z++)
  {
    for($x=-20; $x<=20; $x++)
    {
      for($y=-20; $y<=20; $y++)
      {
        $hexaPoint = array($x, $y, $z, 1);
        if (distanceHexaReal($zeroP, $hexaPoint) > 15) continue; // this is used to show the ball
        $screenPoint = vectorMultiMatrix($hexaPoint, $mHexaToScreen);
        $col = dechex((255 / 160 * $screenPoint[2]) );
        if (strlen($col)==1) $col = '0'.$col;
        echo '<div style="width:6px;height:6px;background:#00'.$col.'00;position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;"></div>';
      }
    }
  }
  echo '</div></body>';
