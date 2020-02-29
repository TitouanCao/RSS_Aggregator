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
        $string = $string."<div class='cell-outer-div' onmouseenter='unfold(this)' onmouseleave='fold(this)'>
                            ".$value->to_string_compact_cell()."
                          </div>";
      }
      else {
        display_err_msg("Illegal State");
      }
    }
    return $string;
  }

}

?>
