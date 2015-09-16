<?php

namespace Drupal\listformat\Manager;

use Drupal\listformat\ListFormat\LfBrokenListFormat;
use Drupal\renderkit\ListFormat\ListFormatInterface;
use Drupal\uniplugin\Manager\InternalUniManagerInterface;

class LfPluginManager implements LfPluginManagerInterface {

  /**
   * @var \Drupal\uniplugin\Manager\InternalUniManagerInterface
   */
  private $uniPluginManager;

  /**
   * EntdispPluginManager constructor.
   *
   * @param \Drupal\uniplugin\Manager\InternalUniManagerInterface $uniPluginManager
   */
  function __construct(InternalUniManagerInterface $uniPluginManager) {
    $this->uniPluginManager = $uniPluginManager;
  }

  /**
   * Gets the element type object to be used in a uikit form element, that
   * allows to choose and configure a plugin of this type.
   *
   * @return \Drupal\uikit\FormElement\UikitElementTypeInterface
   */
  function getUikitElementType() {
    return $this->uniPluginManager->getUikitElementType(t('Listformat plugin'));
  }

  /**
   * @param array $settings
   *   Format: array('plugin_id' => :string, 'plugin_options' => :array)
   *
   * @return string
   */
  function settingsGetSummary(array $settings) {
    return $this->uniPluginManager->settingsGetSummary($settings);
  }

  /**
   * @param array $settings
   *   Format: array('plugin_id' => :string, 'plugin_options' => :array)
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   */
  function settingsGetListFormat(array $settings) {
    $handler = $this->uniPluginManager->settingsGetHandler($settings);
    return $handler instanceof ListFormatInterface
      ? $handler
      : LfBrokenListFormat::create()->setInvalidHandler($handler);
  }
}
