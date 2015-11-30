<?php

namespace Drupal\listformat\Manager;

use Drupal\uniplugin\Manager\UniManagerInterface;

interface LfManagerInterface extends UniManagerInterface {

  /**
   * @param array $conf
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   */
  function confGetListFormat(array $conf);

}
