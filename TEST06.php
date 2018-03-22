<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #7
  // the last test can be made more easier
  // by using the function distanceHexaFields()
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
    for($y=-3; $y<=3; $y++)
    {
      $hexaPoint = array($x, $y, 0, 0);
      // the following line has been added
      if (distanceHexaFields($zeroPoint, $hexaPoint) > 3) continue;
      $screenPoint = vectorMultiMatrix($hexaPoint, $mHexaToScreen);
      echo '<img src="'.$img.'" style="position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;">';
    }
  }
  echo '</div></div>';
