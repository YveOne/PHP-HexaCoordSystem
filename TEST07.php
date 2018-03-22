<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #8
  // and with the function distanceHexaFields we can also show just one ring
  //

  $img = 'images/hexagon.png';
  $xDiffOnX = 190;
  $yDiffOnX = 190;
  $xDiffOnY = -69;
  $yDiffOnY = 256;
  $mHexaToScreen = matrixHexaProjection($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY);
  $zeroPoint = array(0,0,0);


  echo '<div style="margin-left:300px;margin-top:300px;position:absolute;"><div style="-moz-transform:scale(0.3);-webkit-transform:scale(0.3);transform:scale(0.3);">';
  for($x=-3; $x<=3; $x++)
  {
//echo "<br>";
    for($y=-3; $y<=3; $y++)
    {
      $hexaPoint = array($x, $y, 0, 0);
//echo "$x/$y = ".distanceHexaFields($zeroPoint, $hexaPoint).'<br>';      
//continue;
      if (distanceHexaFields($zeroPoint, $hexaPoint) == 3)
      {
        $screenPoint = vectorMultiMatrix($hexaPoint, $mHexaToScreen);
        echo '<img src="'.$img.'" style="position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;">';
      }
    }
  }
  echo '</div></div>';
