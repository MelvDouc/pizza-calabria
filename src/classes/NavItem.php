<?php

class NavItem
{
  public $slug;
  public $text;

  function __construct($slug, $text)
  {
    $this->slug = $slug;
    $this->text = $text;
  }

  function display()
  {
    echo ("<li>
      <a href='?$this->slug'>$this->text</a>
    </li>");
  }
}
