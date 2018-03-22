<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  if (!function_exists('distance3'))
  {
  function distance3($p1, $p2)
  {
    return sqrt(pow($p1[0]-$p2[0],2)+pow($p1[1]-$p2[1],2)+pow($p1[2]-$p2[2],2));
  }
  }

  if (!function_exists('normalize3'))
  {
  function normalize3(&$v)
  {
    $d = sqrt(pow($v[0],2)+pow($v[1],2)+pow($v[2],2));
    $v[0] /= $d;
    $v[1] /= $d;
    $v[2] /= $d;
  }
  }

  if (!function_exists('normalized3'))
  {
  function normalized3($v)
  {
    $d = sqrt(pow($v[0],2)+pow($v[1],2)+pow($v[2],2));
    return array(
      $v[0] / $d,
      $v[1] / $d,
      $v[2] / $d
    );
  }
  }

  if (!function_exists('dot3'))
  {
  function dot3($v1, $v2)
  {
    return $v1[0]*$v2[0]+$v1[1]*$v2[1]+$v1[2]*$v2[2];
  }
  }

  if (!function_exists('cross3'))
  {
  function cross3($v1, $v2)
  {
    return array(
      $v1[1]*$v2[2] - $v2[1]*$v1[2],
      $v1[2]*$v2[0] - $v2[2]*$v1[0],
      $v1[0]*$v2[1] - $v2[0]*$v1[1]
    );
  }
  }
