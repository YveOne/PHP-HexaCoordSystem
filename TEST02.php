<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #3
  // How to rotate a hexa-point ... with just one matrix
  // 

  $mHexaToReal = matrixHexaProjectionReal();
  $mRealToHexa = matrixInverse($mHexaToReal);
  $mRota = matrixRotationZ(deg2rad(120));
  // ( mHexaToRealScreen * mRota ) * mRealScreenToHexa
  $m = matrixMultiMatrix(
    matrixMultiMatrix(
      $mHexaToReal,
      $mRota
    ),
    $mRealToHexa
  );

  // our point again
  $x = 2;
  $y = 1;
  $z = 0; // dont need that yet
  $w = 1; // width
  $hexa = array($x, $y, $z, $w);
  echo '<pre>';print_r($hexa);echo '</pre>';

  // and rotated in one step
  $hexa = vectorMultiMatrix($hexa, $m);
  echo '<pre>';print_r($hexa);echo '</pre>';
