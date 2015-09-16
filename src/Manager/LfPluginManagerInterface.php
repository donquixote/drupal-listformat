<?php

namespace Drupal\listformat\Manager;

use Drupal\uniplugin\Manager\UniPluginManagerBaseInterface;

interface LfPluginManagerInterface extends UniPluginManagerBaseInterface {

  /**
   * @param array $settings
   *   Format: array('plugin_id' => :string, 'plugin_options' => :array)
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   */
  function settingsGetListFormat(array $settings);

}
