<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  // http://mathworld.wolfram.com/Cotangent.html
  // http://en.wikipedia.org/wiki/Law_of_cotangents
  if (!function_exists('cot'))
  {
  function cot($rad)
  {
    return cos($rad) / sin($rad);
  }
  }
