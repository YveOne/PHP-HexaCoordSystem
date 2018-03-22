<?php

//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 2 (17.01.2013)
//

//-----------------------------------------------------------------------------------------

  function distance2d($x1, $y1, $x2, $y2)
  {
    return sqrt(pow($x1-$x2,2) + pow($y1-$y2,2));
  }
  function distance3d($x1, $y1, $z1, $x2, $y2, $z2)
  {
    return sqrt(pow($x1-$x2,2) + pow($y1-$y2,2) + pow($z1-$z2,2));
  }
  function distanceHexa($x1, $y1, $x2, $y2)
  {
    return sqrt(pow($x1-$x2,2) + pow($y1-$y2,2) + pow(($x1-$x2)-($y1-$y2),2)) / sqrt(2);
  }

//-----------------------------------------------------------------------------------------

  function matrixIdentity($size = 2)
  {
    $m = array_fill(0, $size*$size, 0);
    for ($d=0; $d<$size; $d++)
      $m[$d*$size+$d] = 1;
    return $m;
  }

  function matrixHexaToScreen($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY)
  {
    return array(
      $xDiffOnX, $xDiffOnY,
      $yDiffOnX, $yDiffOnY
    );
  }

  function matrixRealHexaToScreen()
  {
    return array(
      cos(deg2rad(-60)), 0,
      sin(deg2rad(-60)), 2*sin(deg2rad(60))
    );
  }
  function matrixScreenToHexa($xDiffOnX, $yDiffOnX, $xDiffOnY, $yDiffOnY)
  {
    if($xDiffOnX==0 && $yDiffOnX==0) return false;
    if($xDiffOnY==0 && $yDiffOnY==0) return false;
    if($xDiffOnX==0 && $xDiffOnY==0) return false;
    if($yDiffOnX==0 && $yDiffOnY==0) return false;
    $pos11 = array($xDiffOnX+$xDiffOnY, $yDiffOnX+$yDiffOnY);
    if($xDiffOnX == 0)
    {
      $m11 = 0;
      $m12 = -1/$yDiffOnY;
    }
    elseif($yDiffOnX == 0)
    {
      $m11 = -1/$xDiffOnY;
      $m12 = 0;
    }
    else
    {
      $nullX = ($pos11[1] / $yDiffOnX * -$xDiffOnX) + $pos11[0];
      $nullY = ($pos11[0] / $xDiffOnX * -$yDiffOnX) + $pos11[1];
      $m11 = (1/$nullY) * ($nullY/$nullX);
      $m12 = 1/$nullY;
    }
    if($xDiffOnY == 0)
    {
      $m21 = 0;
      $m22 = -1/$yDiffOnX;
    }
    elseif($yDiffOnY == 0)
    {
      $m21 = -1/$xDiffOnX;
      $m22 = 0;
    }
    else
    {
      $nullX = ($pos11[1] / $yDiffOnY * -$xDiffOnY) + $pos11[0];
      $nullY = ($pos11[0] / $xDiffOnY * -$yDiffOnY) + $pos11[1];
      $m21 = (1/$nullY) * ($nullY/$nullX);
      $m22 = 1/$nullY;
    }
    return array(
      $m11, $m12,
      $m21, $m22
    );
  }

  function matrixScreenToRealHexa()
  {
    return matrixScreenToHexa(cos(deg2rad(-60)), sin(deg2rad(-60)), 0, 2*sin(deg2rad(60)));
  }

//-----------------------------------------------------------------------------------------

  function matrixRotation($rad)
  {
    return array(
      cos($rad), -sin($rad),
      sin($rad), cos($rad)
    );
  }

  function matrixRoationSimple($count)
  {
    switch(($count>=0) ? ((int)$count%6) : (5-(-(int)$count%6)))
    {
      // 0° = x=x y=y
      case 0:
        return array(
          1, 0,
          0, 1
        );
      // 60° = x=x-y y=x
      case 1:
        return array(
          1, -1,
          1, 0
        );
      // 120° = x=-y y=x-y
      case 0:
        return array(
          0, -1,
          1, -1
        );
      // 180° = x=-x y=-y
      case 0:
        return array(
          -1, 0,
          0, -1
        );
      // 240° = x=x-y y=-x
      case 0:
        return array(
          1, -1,
          -1, 0
        );
      // 300° = x=y y=y-x
      case 0:
        return array(
          0, 1,
          -1, 1
        );
    }
  }

//-----------------------------------------------------------------------------------------

  function matrixMultiMatrix($m1, $m2)
  {
    return array(
      ($m1[ 0]*$m2[ 0]+$m1[ 2]*$m2[ 1]), ($m1[ 1]*$m2[ 0]+$m1[ 3]*$m2[ 1]),
      ($m1[ 0]*$m2[ 2]+$m1[ 2]*$m2[ 3]), ($m1[ 1]*$m2[ 2]+$m1[ 3]*$m2[ 3])
    );
  }

  function vectorMultiMatrix($vector, $matrix)
  {
    return array(
      ($vector[ 0]*$matrix[ 0]) + ($vector[ 1]*$matrix[ 1]),
      ($vector[ 0]*$matrix[ 2]) + ($vector[ 1]*$matrix[ 3])
    );
  }

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

//-----------------------------------------------------------------------------------------

