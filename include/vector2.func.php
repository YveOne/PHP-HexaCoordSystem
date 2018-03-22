<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  if (!function_exists('distance2'))
  {
  function distance2($p1, $p2)
  {
    return sqrt(pow($p1[0]-$p2[0],2)+pow($p1[1]-$p2[1],2));
  }
  }

  if (!function_exists('normalize2'))
  {
  function normalize2(&$v)
  {
    $d = sqrt(pow($v[0],2)+pow($v[1],2));
    $v[0] /= $d;
    $v[1] /= $d;
  }
  }

  if (!function_exists('normalized2'))
  {
  function normalized2($v)
  {
    $d = sqrt(pow($v[0],2)+pow($v[1],2));
    return array(
      $v[0] / $d,
      $v[1] / $d
    );
  }
  }

  if (!function_exists('dot2'))
  {
  function dot2($v1, $v2)
  {
    return $v1[0]*$v2[0]+$v1[1]*$v2[1];
  }
  }

  if (!function_exists('cross2'))
  {
  function cross2($v)
  {
    return array($v[1], -$v[0]);
  }
  }
