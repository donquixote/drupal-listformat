<?php

namespace Drupal\listformat\Plugin\views\style;

class ListFormatViewsStylePlugin extends ViewsStylePluginBase {

  /**
   * Set default options
   */
  function option_definition() {
    $options = parent::option_definition();

    $options['listformat'] = array('default' => array());

    return $options;
  }

  /**
   * Render the given style.
   *
   * @param array $form
   * @param array $form_state
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['listformat'] = array(
      '#type' => UIKIT_ELEMENT_TYPE,
      '#uikit_element_object' => listformat()->getUikitElementType(),
      '#default_value' => $this->options['listformat'],
    );
  }

  /**
   * Returns the summary of the settings in the display.
   */
  function summary_title() {
    return listformat()->settingsGetSummary($this->options['listformat']);
  }

  /**
   * @param string[] $rows
   * @param string $title
   * @param int $grouping_level
   *
   * @return string
   */
  protected function renderRows(array $rows, $title, $grouping_level) {
    $builds = array();
    foreach ($rows as $delta => $row_html) {
      $builds[$delta]['#markup'] = $row_html;
    }
    $listformat = listformat()->settingsGetListFormat($this->options['listformat']);
    $build = $listformat->buildList($builds);
    return drupal_render($build);
  }

}
