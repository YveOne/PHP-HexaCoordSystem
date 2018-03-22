<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #4
  // How to get screen point by using custom hexagon values
  //
  // xDiffOnX = how much does screen-x change when hexa-x changes by +1 ?
  // yDiffOnX = how much does screen-y change when hexa-x changes by +1 ?
  //
  // xDiffOnY = how much does screen-x change when hexa-y changes by +1 ?
  // yDiffOnY = how much does screen-y change when hexa-y changes by +1 ?
  //

  $xDiffOnX = 3;
  $yDiffOnX = 1;
  $xDiffOnY = 0;
  $yDiffOnY = 2;
  $mHexaToScreen = matrixHexaProjection($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY);
  $mScreenToHexa = matrixInverse($mHexaToScreen);

  // our point ... once again
  $x = 3;
  $y = 0;
  $z = 0; // dont need that yet
  $w = 1; // width
  $hexa = array($x, $y, $z, $w);
  echo '<pre>';print_r($hexa);echo '</pre>';

  // project to custom screen
  $screen = vectorMultiMatrix($hexa, $mHexaToScreen);
  echo '<pre>';print_r($screen);echo '</pre>';

  // project back to hexa
  $hexa = vectorMultiMatrix($screen, $mScreenToHexa);
  echo '<pre>';print_r($hexa);echo '</pre>';

  //
  // WARNING
  // dont rotate the points while they are projected into custom screen
  // because the sizes of each hexagon wont be homogeneous
  // and you will get false values in the end
  //
