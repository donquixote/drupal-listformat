<?php

namespace Drupal\listformat\ListFormat;

use Drupal\renderkit\ListFormat\ListFormatInterface;

class LfBrokenListFormat implements ListFormatInterface {

  /**
   * @var mixed
   */
  private $invalidHandler;

  /**
   * @return static
   */
  static function create() {
    return new static();
  }

  /**
   * @param mixed $invalidHandler
   *
   * @return $this
   */
  public function setInvalidHandler($invalidHandler) {
    $this->invalidHandler = $invalidHandler;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getInvalidHandler() {
    return $this->invalidHandler;
  }

  /**
   * @param array[] $builds
   *   Array of render arrays for list items.
   *   Must not contain any property keys like "#..".
   *
   * @return array
   *   Render array for the list.
   */
  function buildList(array $builds) {
    return array();
  }

}
