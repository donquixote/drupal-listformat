<?php

namespace Drupal\listformat\CtoolsPlugin\views\style;

use Drupal\cfrapi\SummaryBuilder\SummaryBuilder_Static;
use Drupal\renderkit\ListFormat\ListFormatInterface;

class ListFormatViewsStylePlugin extends ViewsStylePluginBase {

  /**
   * Set default options
   */
  public function option_definition() {
    $options = parent::option_definition();

    $options['listformat'] = ['default' => []];

    return $options;
  }

  /**
   * Render the given style.
   *
   * @param array $form
   * @param array $form_state
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['listformat'] = [
      '#type' => 'cfrplugin',
      '#cfrplugin_interface' => ListFormatInterface::class,
      '#title' => t('List format'),
      '#default_value' => $this->options['listformat'],
    ];
  }

  /**
   * Returns the summary of the settings in the display.
   */
  public function summary_title() {
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

    $builds = [];
    foreach ($rows as $delta => $row_html) {
      $builds[$delta]['#markup'] = $row_html;
    }

    try {
      $build = listformat()
        ->confGetListFormat($this->options['listformat'])
        ->buildList($builds);

      return drupal_render($build);
    }
    catch (\Exception $e) {
      watchdog('cfrplugin',
        'Broken listformat plugin in Views style plugin for @view_name/@display_id.',
        [
          '@view_name' => $this->view->name,
          '@display_id' => $this->view->current_display,
        ],
        WATCHDOG_WARNING);

      return '';
    }
  }

}
