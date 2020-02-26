<?php

class Week {
  public $days;
  public $lastDay;

  function __construct($last) {
    $this->days = array();
    for ($i = 0; $i < 7; $i++) {
      array_push($this->days, new Day);
    }
    $this->lastDay = $last;
  }

  function insert_event($event){
    if ($event instanceof Podcast) {
      if ($event->date->format("D") == "Mon") {
        $this->days[0]->insert_event($event);
      }
      if ($event->date->format("D") == "Tue") {
        $this->days[1]->insert_event($event);
      }
      if ($event->date->format("D") == "Wed") {
        $this->days[2]->insert_event($event);
      }
      if ($event->date->format("D") == "Thu") {
        $this->days[3]->insert_event($event);
      }
      if ($event->date->format("D") == "Fri") {
        $this->days[4]->insert_event($event);
      }
      if ($event->date->format("D") == "Sat") {
        $this->days[5]->insert_event($event);
      }
      if ($event->date->format("D") == "Sun") {
        $this->days[6]->insert_event($event);
      }
    }
    else {
      display_err_msg("Illegal State");
    }
  }

  function is_empty() {
    foreach($this->days as $value) {
      if (!($value->is_empty())) {
        return false;
      }
    }
    return true;
  }

  function to_string() {
    if ($this->is_empty()){
      $string = "<tr>";
      for ($i = 0; $i < 7; $i++) {
        $string = $string."<td class='dead-cell'></td>";
      }
      $string = $string."</tr>";
      return $string;
    }
    else {
      return "<tr>
                <td>
                ".$this->days[0]->to_string()."
                </td>
                <td>
                ".$this->days[1]->to_string()."
                </td>
                <td>
                ".$this->days[2]->to_string()."
                </td>
                <td>
                ".$this->days[3]->to_string()."
                </td>
                <td>
                ".$this->days[4]->to_string()."
                </td>
                <td>
                ".$this->days[5]->to_string()."
                </td>
                <td>
                ".$this->days[6]->to_string()."
                </td>
              </tr>";
    }

  }

}

?>
