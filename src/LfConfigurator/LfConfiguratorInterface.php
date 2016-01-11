<?php

namespace Drupal\listformat\LfConfigurator;

use Drupal\cfrapi\RawConfigurator\RawConfiguratorInterface;

interface LfConfiguratorInterface extends RawConfiguratorInterface {

  /**
   * @param array $conf
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   */
  function confGetListFormat(array $conf);

}
