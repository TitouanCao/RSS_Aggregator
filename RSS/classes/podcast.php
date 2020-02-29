<?php

class Podcast {
  public $title;
  public $date;
  public $description;
  public $pageLink;
  public $audioLink;
  public $duration;
  public $source;

  function __construct($title, $date, $description, $pageLink, $audioLink, $duration, $source) {
    $this->title = $title;
    $this->date = $date;
    $this->description = $description;
    $this->pageLink = $pageLink;
    $this->audioLink = $audioLink;
    $this->duration = $duration;
    $this->source = $source;
  }

  function to_string_table_row() {
    if (!isset($_SESSION["resourcesLocation"])) return display_err_msg("Session not found");
    return "<tr>
            <td>
            ".$this->source->name."
            </td>
            <td>
              ".$this->date->format("Y, D d \of F, \a\\t G:i:s")."
            </td>
            <td>
              <a href=".$this->pageLink." target='_blank'>
                <div class='tooltip'>
                <span class='text-expander'>".$this->title."</span>
                <span class=' tooltip-text tooltip-row'> ".$this->description."</span>
                </div>
              </a>
            </td>
            <td>
              <audio controls preload='none' src=".$this->audioLink.">
                Your browser does not support the audio element.
              </audio>
            </td>
            <td>
              ".$this->duration."
            </td>
            <td>
              <a href=".$this->audioLink." download='".$this->title."mp3'>
                <img src='".$_SESSION["resourcesLocation"]."download-arrow.png' alt='download-arrow-icon' class='dld'>
              </a>
            </td>
          </tr>
          <tr class='row-row'>
            <td colspan='6'>
              <div class='row-style'></div>
            </td>
          </tr>";
  }

  function to_string_table_row_week_number() {
    return "<tr>
              <td colspan='6' class='spacer'>
                Week n°".$this->date->format('W')."
              </td>
            </tr>";
  }

  function to_string_table_row_day() {
    return "<tr>
              <td colspan='6' class='small-spacer'>
                ".$this->date->format('D')." ".$this->date->format('d')." of ".$this->date->format('F')."
              </td>
            </tr>";
  }

  function to_string_compact_cell() {
    if (!isset($_SESSION["resourcesLocation"])) return display_err_msg("Session not found");
    if ($this->date->format("D") == "Sun" || $this->date->format("D") == "Sat" || $this->date->format("D") == "Fri") $tooltipClass = "right";
    else $tooltipClass = "left";
    return "<div id=".spl_object_hash($this)." class='audio-icon' onclick='switch_audio(this.id)'>
              <img src='".$_SESSION["resourcesLocation"]."play.png' alt='audio situation icon' width='40px'>
            </div>
            <div class='cell-inner-div' style='background-color:".$this->source->color.";' onmousedown='return false;'>
              <div class='compact-span'>".$this->date->format("d F Y")."</div>
              <div class='compact-title'>
                <a href='$this->pageLink' target='_blank'>
                  <div class='tooltip'>
                  ".$this->title."
                  <span class='tooltip-text tooltip-compact-".$tooltipClass."'>".$this->description."</span>
                  </div>
                </a>
              </div>
              <audio preload='none' src=".$this->audioLink.">
                Your browser does not support the audio element.
              </audio>
            </div>";
  }


}


?>
