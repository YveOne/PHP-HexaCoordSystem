<?php

  include('include/hexa.func.php');
  include('include/matrix.func.php');

  //
  // Example #2
  // How to rotate a hexa-point
  //
  // step 1: project to real 3d position
  // step 2: rotate this point normaly
  // step 3: project back to hexa
  // 

  $mHexaToReal = matrixHexaProjectionReal();
  $mRota = matrixRotationZ(deg2rad(120));
  $mRealToHexa = matrixInverse($mHexaToReal);

  // our original point
  $x = 2;
  $y = 1;
  $z = 0; // dont need that yet
  $w = 1; // width, dont need that yet
  $hexa = array($x, $y, $z, $w);
  echo "(hexa 0) x /y = $hexa[0] / $hexa[1] <br>";

  // screen position
  $real = vectorMultiMatrix($hexa, $mHexaToReal);
  echo "(real 0) x /y = $real[0] / $real[1] <br>";

  // rotate it
  $real = vectorMultiMatrix($real, $mRota);
  echo "(real 120) x /y = $real[0] / $real[1] <br>";

  // and back to hexa
  $hexa = vectorMultiMatrix($real, $mRealToHexa);
  echo "(hexa 120) x /y = $hexa[0] / $hexa[1] <br>";
