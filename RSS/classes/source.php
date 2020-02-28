<?php

class Source {
  public $name;
  public $src;
  public $color;
  public $twitter;

  function __construct($name, $src, $color, $twitter = null) {
    $this->name = $name;
    $this->src = $src;
    $this->twitter = $twitter;
    $this->color = $color;
  }

  function is_correct() {
    if ($this->name == null || $this->name == "") return false;
    if ($this->src == null || $this->src == "") return false;
    return true;
  }

  function has_color() {
    return $this->color != null && $this->color != "" && (preg_match("#\#[a-f0-9]{6}#", $this->color) ||
    in_array($this->color, $_SESSION["colors"]) ||
    in_array($this->color, array_map('mb_strtolower', $_SESSION["colors"])));
  }

  function has_twitter() {
    return $this->twitter != null && $this->twitter != "";
  }

  function to_string() {
    return "\"".$this->name."\", \"".$this->src."\", \"".$this->color."\", \"".$this->twitter."\"";
  }

  function has_conflict($source) {
    if (trim($this->name) == trim($source->name) || trim($this->src) == trim($source->src)) {
      return true;
    }
    else return false;
  }

  function is_same_feed($source) {
    return trim($this->src) == trim($source->src);
  }

  function is_same_name($source) {
    return trim($this->name) == trim($source->name);
  }

}

?>
