<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  if (!function_exists('matrixLookAtLH'))
  {
  function matrixLookAtLH($eye, $target, $up)
  {
    $z = normalized3(
      array(
        $target[0] - $eye[0],
        $target[1] - $eye[1],
        $target[2] - $eye[2]
      )
    );
    $x = normalized3(cross3($up, $z));
    $y = cross3($z, $x);
    return matrixInverse(
      array(
        $x[0], $y[0], $z[0], $eye[0],
        $x[1], $y[1], $z[1], $eye[1],
        $x[2], $y[2], $z[2], $eye[2],
        0, 0, 0, 1
      )
    );
  }
  }

  if (!function_exists('matrixPerspectiveFovLH'))
  {
  function matrixPerspectiveFovLH($fov, $aspectRatio, $near, $far)
  {
    $f = 1 / tan($fov * 0.5);
    return array(
      $f*$aspectRatio, 0, 0, 0,
      0, -$f, 0, 0,
//      0, 0, ($far+$near)/($far-$near), (2*$near*$far)/($near-$far),
//      0, 0, 1, 0
      0, 0, 1, 0,
      0, 0, 0, 1
    );
  }
  }
