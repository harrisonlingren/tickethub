<?php

  class Showtime {
    public $time = '';
    public $theater = '';
    public $open_seats = '';
    public $ID = '';

    function Showtime($t, $c, $s, $i) {
      $this->time = $t;
      $this->theater = $c;
      $this->open_seats = $s;
      $this->ID = $i;
    }
  }

?>
