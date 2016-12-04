<?php

  class Showtime {
    public $title = '';
    public $times = array();
    public $theater = '';
    public $open_seats = '';

    function __contsruct($m, $d, $t, $c, $s) {
      $this->movie = $m;
      $this->date = $d;
      if(!is_array($t)) {
        throw new Exception("Illegal argument: $t");
      } else {
        $this->times = $t;
      }
      $this->theater = $c;
      $this->open_seats = $s;
    }

    function addTime($time) {
      array_push($this->$times, $time);
    }
  }

?>
