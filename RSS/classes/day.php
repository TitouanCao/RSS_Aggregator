<?php

class Day {
  public $events;

  function __construct() {
    $this->events = array();
  }

  function insert_event($event) {
    array_push($this->events, $event);
  }

  function is_empty() {
    return count($this->events) == 0;
  }

  function to_string() {
    $string = "";
    foreach ($this->events as $value) {
      if ($value instanceof Podcast){
        $string = $string."".$value->to_string_compact_cell();
      }
      else {
        display_err_msg("Illegal State");
      }
    }
    return $string;
  }

}

?>
