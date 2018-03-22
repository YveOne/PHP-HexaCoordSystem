<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  // http://en.wikipedia.org/wiki/Identity_matrix
  if (!function_exists('matrixIdentity'))
  {
  function matrixIdentity($size = 4)
  {
    $m = array_fill(0, $size*$size, 0);
    for ($d=0; $d<$size; $d++)
      $m[$d*$size+$d] = 1;
    return $m;
  }
  }

  // http://en.wikipedia.org/wiki/Euler_angles
  if (!function_exists('matrixYawPitchRoll'))
  {
  function matrixYawPitchRoll($radZ, $radY, $radX)
  {
    $cosZ = cos($radZ);
    $sinZ = sin($radZ);
    $cosY = cos($radY);
    $sinY = sin($radY);
    $cosX = cos($radX);
    $sinX = sin($radX);
    return array(
      ($cosZ*$cosY), ($cosZ*$sinY*$sinX-$sinZ*$cosX), ($cosZ*$sinY*$cosX+$sinZ*$sinX), 0,
      ($sinZ*$cosY), ($sinZ*$sinY*$sinX+$cosZ*$cosX), ($sinZ*$sinY*$cosX-$cosZ*$sinX), 0,
      (-$sinY)     , ($cosY*$sinX)                  , ($cosY*$cosX)                  , 0,
      0            , 0                              , 0                              , 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Rotation_matrix#Rotation_matrix_from_axis_and_angle
  if (!function_exists('matrixRotationAxis'))
  {
  function matrixRotationAxis($axis, $rad)
  {
    $cos = cos($rad);
    $sin = sin($rad);
    $cos2 = 1-$cos;
    return array(
      ($axis[0]*$axis[0]*$cos2+         $cos), ($axis[1]*$axis[0]*$cos2-$axis[2]*$sin), ($axis[2]*$axis[0]*$cos2+$axis[1]*$sin), 0,
      ($axis[0]*$axis[1]*$cos2+$axis[2]*$sin), ($axis[1]*$axis[1]*$cos2+         $cos), ($axis[2]*$axis[1]*$cos2-$axis[0]*$sin), 0,
      ($axis[0]*$axis[2]*$cos2-$axis[1]*$sin), ($axis[1]*$axis[2]*$cos2+$axis[0]*$sin), ($axis[2]*$axis[2]*$cos2+         $cos), 0,
      0                                      , 0                                      , 0                                      , 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Rotation_matrix#Basic_rotations
  if (!function_exists('matrixRotationX'))
  {
  function matrixRotationX($rad)
  {
    return array(
      1, 0, 0, 0,
      0, cos($rad), -sin($rad), 0,
      0, sin($rad), cos($rad), 0,
      0, 0, 0, 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Rotation_matrix#Basic_rotations
  if (!function_exists('matrixRotationY'))
  {
  function matrixRotationY($rad)
  {
    return array(
      cos($rad), 0, sin($rad), 0,
      0, 1, 0, 0,
      -sin($rad), 0, cos($rad), 0,
      0, 0, 0, 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Rotation_matrix#Basic_rotations
  if (!function_exists('matrixRotationZ'))
  {
  function matrixRotationZ($rad)
  {
    return array(
      cos($rad), -sin($rad), 0, 0,
      sin($rad), cos($rad), 0, 0,
      0, 0, 1, 0,
      0, 0, 0, 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Scaling_%28geometry%29#Matrix_representation
  // http://en.wikipedia.org/wiki/Transformation_matrix#Scaling
  if (!function_exists('matrixScale'))
  {
  function matrixScale($v)
  {
    return array(
      $v[0], 0, 0, 0,
      0, $v[1], 0, 0,
      0, 0, $v[2], 0,
      0, 0, 0, 1
    );
  }
  }

  // http://en.wikipedia.org/wiki/Translation_matrix
  if (!function_exists('matrixTranslation'))
  {
  function matrixTranslation($v)
  {
    return array(
      1, 0, 0, $v[0],
      0, 1, 0, $v[1],
      0, 0, 1, $v[2],
      0, 0, 0, 1
    );
  }
  }

  // http://www.quickmath.com/webMathematica3/quickmath/matrices/inverse/basic.jsp
  // http://en.wikipedia.org/wiki/Gauss%E2%80%93Jordan_elimination
  if (!function_exists('matrixInverse'))
  {
  function matrixInverse($in)
  {
    $size = sqrt(count($in));
    if ($size % 1 != 0) return false;
    $out = matrixIdentity($size);
    for ($dia=0; $dia<$size; $dia++)
    {
      if ($in[$dia*$size+$dia] == 0)
      {
        $error = true;
        for ($row = 0; $row<$size; $row++)
        {
          if ($in[$row*$size+$dia] != 0)
          {
            for ($col=0; $col<$size; $col++)
            {
              $in[$dia*$size+$col] += $in[$row*$size+$col];
              $out[$dia*$size+$col] += $out[$row*$size+$col];
            }
            $error = false;
            break;
          }
        }
        if ($error) return false;
      }
    }
    for ($dia=0; $dia<$size-1; $dia++)
    {
      for ($row=$dia+1; $row<$size; $row++)
      {
        $n = $in[$row*$size+$dia];
        if ($n == 0) continue;
        $m = $in[$dia*$size+$dia];
        for ($col=0; $col<$size; $col++)
        {
          $in[$row*$size+$col] = $in[$row*$size+$col]*$m - $in[$dia*$size+$col]*$n;
          $out[$row*$size+$col] = $out[$row*$size+$col]*$m - $out[$dia*$size+$col]*$n;
        }
      }
    }
    for ($dia=0; $dia<$size; $dia++)
    {
      $v = $in[$dia*$size+$dia];
      for ($col=0; $col<$size; $col++)
      {
        $in[$dia*$size+$col] /= $v;
        $out[$dia*$size+$col] /= $v;
      }
    }
    for ($dia=$size-1; $dia>0; $dia--)
    {
      for ($row=0; $row<$dia; $row++)
      {
        $n = $in[$row*$size+$dia];
        if ($n == 0) continue;
        for ($col=0; $col<$size; $col++)
        {
          //$in[$row*$size+$col] = $in[$row*$size+$col] - $in[$dia*$size+$col]*$n;
          $out[$row*$size+$col] = $out[$row*$size+$col] - $out[$dia*$size+$col]*$n;
        }
      }
    }
    return $out;
  }
  }

  if (!function_exists('matrixMultiMatrix'))
  {
  function matrixMultiMatrix($m1, $m2)
  {
    return array(
      ($m1[ 0]*$m2[ 0]+$m1[ 4]*$m2[ 1]+$m1[ 8]*$m2[ 2]+$m1[12]*$m2[ 3]), ($m1[ 1]*$m2[ 0]+$m1[ 5]*$m2[ 1]+$m1[ 9]*$m2[ 2]+$m1[13]*$m2[ 3]), ($m1[ 2]*$m2[ 0]+$m1[ 6]*$m2[ 1]+$m1[10]*$m2[ 2]+$m1[14]*$m2[ 3]), ($m1[ 3]*$m2[ 0]+$m1[ 7]*$m2[ 1]+$m1[11]*$m2[ 2]+$m1[15]*$m2[ 3]),
      ($m1[ 0]*$m2[ 4]+$m1[ 4]*$m2[ 5]+$m1[ 8]*$m2[ 6]+$m1[12]*$m2[ 7]), ($m1[ 1]*$m2[ 4]+$m1[ 5]*$m2[ 5]+$m1[ 9]*$m2[ 6]+$m1[13]*$m2[ 7]), ($m1[ 2]*$m2[ 4]+$m1[ 6]*$m2[ 5]+$m1[10]*$m2[ 6]+$m1[14]*$m2[ 7]), ($m1[ 3]*$m2[ 4]+$m1[ 7]*$m2[ 5]+$m1[11]*$m2[ 6]+$m1[15]*$m2[ 7]),
      ($m1[ 0]*$m2[ 8]+$m1[ 4]*$m2[ 9]+$m1[ 8]*$m2[10]+$m1[12]*$m2[11]), ($m1[ 1]*$m2[ 8]+$m1[ 5]*$m2[ 9]+$m1[ 9]*$m2[10]+$m1[13]*$m2[11]), ($m1[ 2]*$m2[ 8]+$m1[ 6]*$m2[ 9]+$m1[10]*$m2[10]+$m1[14]*$m2[11]), ($m1[ 3]*$m2[ 8]+$m1[ 7]*$m2[ 9]+$m1[11]*$m2[10]+$m1[15]*$m2[11]),
      ($m1[ 0]*$m2[12]+$m1[ 4]*$m2[13]+$m1[ 8]*$m2[14]+$m1[12]*$m2[15]), ($m1[ 1]*$m2[12]+$m1[ 5]*$m2[13]+$m1[ 9]*$m2[14]+$m1[13]*$m2[15]), ($m1[ 2]*$m2[12]+$m1[ 6]*$m2[13]+$m1[10]*$m2[14]+$m1[14]*$m2[15]), ($m1[ 3]*$m2[12]+$m1[ 7]*$m2[13]+$m1[11]*$m2[14]+$m1[15]*$m2[15])
    );
  }
  }

  if (!function_exists('vectorMultiMatrix'))
  {
  function vectorMultiMatrix($v, $m)
  {
    return array(
      ($v[ 0]*$m[ 0]+$v[ 1]*$m[ 1]+$v[ 2]*$m[ 2]+$v[ 3]*$m[ 3]),
      ($v[ 0]*$m[ 4]+$v[ 1]*$m[ 5]+$v[ 2]*$m[ 6]+$v[ 3]*$m[ 7]),
      ($v[ 0]*$m[ 8]+$v[ 1]*$m[ 9]+$v[ 2]*$m[10]+$v[ 3]*$m[11]),
      ($v[ 0]*$m[12]+$v[ 1]*$m[13]+$v[ 2]*$m[14]+$v[ 3]*$m[15])
    );
  }
  }
