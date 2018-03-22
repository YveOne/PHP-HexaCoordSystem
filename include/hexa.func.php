<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 3 (21.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  if (!defined('M_TRIPYRAMID_H'))         define('M_TRIPYRAMID_H',        sqrt(6)/3           );
  if (!defined('M_COS30'))                define('M_COS30',               cos(deg2rad(30))    );
  if (!defined('M_SIN30'))                define('M_SIN30',               sin(deg2rad(30))    );
  if (!defined('M_COS30_3'))              define('M_COS30_3',             M_COS30/3           ); // why /3 ??? http://en.wikipedia.org/wiki/Barycentric_coordinates_%28mathematics%29

  if (!function_exists('distanceHexaFields'))
  {
  function distanceHexaFields($v1, $v2)
  {
    $x = $v2[0] - $v1[0];
    $y = $v2[1] - $v1[1];
    $z = $v2[2] - $v1[2];
    return max(
      max(
        max(
          abs($z+$x),
          abs($z+$y)
        ),
        max(
          abs($x+$y),
          abs($x+$y+$z)
        )
      ),
      max(
        abs($x),
        max(
          abs($y),
          abs($z)
        )
      )
    );
  }
  }

  if (!function_exists('distanceHexaReal'))
  {
  function distanceHexaReal($v1, $v2)
  {
    $x = $v1[0] - $v2[0];
    $y = $v1[1] - $v2[1];
    $z = $v1[2] - $v2[2];
    return sqrt( $x*$x + $y*$y + $z*$z + $x*$y + $x*$z + $y*$z);
  }
  }

  if (!function_exists('matrixHexaProjection'))
  {
  function matrixHexaProjection($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY, $xDiffOnZ=0, $yDiffOnZ=0, $zDiffOnZ=1)
  {
    return array(
      $xDiffOnX, $xDiffOnY, $xDiffOnZ, 0,
      $yDiffOnX, $yDiffOnY, $yDiffOnZ, 0,
      0,         0,         $zDiffOnZ, 0,
      0,         0,         0,         1
    );
  }
  }

  if (!function_exists('matrixHexaProjectionReal'))
  {
  function matrixHexaProjectionReal()
  {
    return array(
      M_COS30, 0, M_COS30_3,            0,
      M_SIN30, 1, M_SIN30,              0,
      0,       0, M_TRIPYRAMID_H,       0,
      0,       0, 0,                    1
    );
  }
  }

/************************************************************************************

Revision 3
- changed default size of matrixIdentity() from 2 to 4
- fixed matrixRoationSimple()
- renamed matrixRoationSimple() to matrixHexaRoationZ()
- removed matrixScreenToHexa() and matrixScreenToRealHexa()
- changed matrix dimensions from 2x2 to 4x4
- prepared system for 3d usuage
- renamed matrixHexaToScreen() to matrixHexaProjection()
- renamed matrixRealHexaToScreen() to matrixHexaProjectionReal()
- fixed matrixHexaProjectionReal()
- removed function matrixHexaRoationZ()

************************************************************************************/
