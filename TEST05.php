<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #6
  // how to create a grid by using an image
  // but: grid with form of a hexagon
  //

  $img = 'images/hexagon.png';
  $xDiffOnX = 190;
  $yDiffOnX = 190;
  $xDiffOnY = -69;
  $yDiffOnY = 256;
  $mHexaToScreen = matrixHexaProjection($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY);

  echo '<div style="margin-left:300px;margin-top:300px;position:absolute;"><div style="-moz-transform:scale(0.3);-webkit-transform:scale(0.3);transform:scale(0.3);">';
  for($x=-3; $x<=3; $x++)
  {
    for($y=-3; $y<=3; $y++)
    {
      // the following line has been added
      if (abs($y)>5 || abs($x)>5 || abs($x+$y)>3) continue;
      $hexaPoint = array($x, $y, 0, 0);
      $screenPoint = vectorMultiMatrix($hexaPoint, $mHexaToScreen);
      echo '<img src="'.$img.'" style="position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;">';
    }
  }
  echo '</div></div>';
