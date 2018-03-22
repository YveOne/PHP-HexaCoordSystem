<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #5
  // how to create a grid by using an image
  //
  // but .. the offset values are incorrect
  // your task: try to fix the problem by changing the ?DiffOn? values and see what happens
  //

  $img = 'images/hexagon.png';
  $xDiffOnX = 220;
  $yDiffOnX = 220;
  $xDiffOnY = -69;
  $yDiffOnY = 256;

  $mHexaToScreen = matrixHexaProjection($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY);

  echo '<div style="margin-left:300px;margin-top:300px;position:absolute;"><div style="-moz-transform:scale(0.3);-webkit-transform:scale(0.3);transform:scale(0.3);">';
  for($x=-3; $x<=3; $x++)
  {
    for($y=-3; $y<=3; $y++)
    {
      $hexaPoint = array($x, $y, 0, 0);
      $screenPoint = vectorMultiMatrix($hexaPoint, $mHexaToScreen);
      echo '<img src="'.$img.'" style="position:absolute;margin-left:'.$screenPoint[0].'px;margin-top:'.$screenPoint[1].'px;">';
    }
  }
  echo '</div></div>';
