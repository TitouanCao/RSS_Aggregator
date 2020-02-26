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
              <a href=".$this->pageLink." target='_blank'><span title='".$this->description."'>".$this->title."</span></a>
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
              <a href=".$this->audioLink." download='".$this->title."mp3' target='_blank'>
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

  function to_string_compact_cell() {
    if (!isset($_SESSION["resourcesLocation"])) return display_err_msg("Session not found");
    $string ="<div class='cell-inner-div' style='background-color:".$this->source->color.";'>
                <div id=".spl_object_hash($this)." class='audio-icon' onclick='switch_audio(this.id)'>
                  <img src='".$_SESSION["resourcesLocation"]."play.png' alt='audio situation icon' width='40px'>
                </div>
                <div class='compact-span'>".$this->date->format("d F Y")."</div>
                <div class='compact-a'><a href='$this->pageLink' target='_blank'><span title='".$this->description."'>".$this->title."</span></a></div>
                <audio preload='none' src=".$this->audioLink.">
                  Your browser does not support the audio element.
                </audio>";
    if ($this->source == "Radio France") {
      $string = $string."<div class='twitter'>
                          <a href='https://twitter.com/lamethodeFC' target='_blank'>
                            <img src='".$_SESSION["resourcesLocation"]."twitter.png' alt='twitter icon' width='60px'>
                          </a>
                        </div>";
    }
    $string = $string."</div>";
    return $string;
  }


}


?>
