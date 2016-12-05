<?php

  class Showtime {
    public $time = '';
    public $theater = '';
    public $open_seats = '';

    function Showtime($t, $c, $s) {
      $this->time = $t;
      $this->theater = $c;
      $this->open_seats = $s;
    }
  }

?>
