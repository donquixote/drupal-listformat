<?php

namespace Drupal\listformat\CtoolsPlugin\views\style;

use Drupal\cfrapi\SummaryBuilder\SummaryBuilder_Static;

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

    $form['listformat'] = listformat()->confGetForm($this->options['listformat'], t('List format'));
  }

  /**
   * Returns the summary of the settings in the display.
   */
  function summary_title() {
    return listformat()->confGetSummary($this->options['listformat'], new SummaryBuilder_Static());
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
    $listformat = listformat()->confGetListFormat($this->options['listformat']);
    $build = $listformat->buildList($builds);
    return drupal_render($build);
  }

}
