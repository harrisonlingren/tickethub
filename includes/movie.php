<?php

  class Movie {
    public $title = '';
    public $times = array();
    public $theater = '';
    public $open_seats = '';

    function Movie($m, $t, $c, $s) {
      $this->movie = $m;
      if(!is_array($t)) {
        throw new Exception("Illegal argument: $t");
      } else {
        $this->times = $t;
      }
      $this->theater = $c;
      $this->open_seats = $s;
    }

    function addTime($time) {
      array_push($this->times, $time);
    }
  }

?>
