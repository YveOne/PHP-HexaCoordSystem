<?php

/////////////////////////////////////////////////////////////////////////
//
// Created by Yvonne P. (Agita[AT]Live[DOT]de)
// Rev 1 (18.01.2013)
//
/////////////////////////////////////////////////////////////////////////

  // micro-precision time
  if (!function_exists('microtime_float'))
  {
  function microtime_float()
  {
      list($usec, $sec) = explode(' ', microtime());
      return ((float)$usec + (float)$sec);
  }
  }
