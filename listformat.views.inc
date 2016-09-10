<?php

/**
 * Implements hook_views_plugins().
 */
function listformat_views_plugins() {
  return [
    'style' => [
      'listformat' => [
        'title' => t('Listformat'),
        'help' => t('Displays rows using a listformat plugin.'),
        'handler' => \Drupal\listformat\CtoolsPlugin\views\style\ListFormatViewsStylePlugin::class,
        'theme' => 'views_view_list',
        'uses row plugin' => TRUE,
        # 'uses row class' => TRUE,
        'uses options' => TRUE,
        'type' => 'normal',
        'help topic' => 'style-list',
      ],
    ],
  ];
}
