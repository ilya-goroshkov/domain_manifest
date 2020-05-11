<?php

namespace Drupal\domain_manifest\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\domain\Entity\Domain;

/**
 * Configure example settings for this site.
 */
class DomainManifestSettingsForm extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'domain_manifest.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'domain_manifest_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }


  /**
   * Retrieve list of all domains.
   *
   * @return \Drupal\Core\Entity\EntityBase[]|\Drupal\Core\Entity\EntityInterface[]
   */
  private function getDomainList() {
    $query        = \Drupal::entityQuery('domain');
    $domains_nids = $query->execute();
    return Domain::loadMultiple($domains_nids);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $domains_list = $this->getDomainList();

    foreach ($domains_list as $domain) {
      $form['domain_settings_' . $domain->id()] = [
        '#type'  => 'details',
        '#title' => $domain->label(),
        '#open'  => FALSE,
      ];

      $form['domain_settings_' . $domain->id()]['name_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Name'),
        '#default_value' => $config->get('name_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['short_name_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Short Name'),
        '#default_value' => $config->get('short_name_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['description_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Description'),
        '#default_value' => $config->get('description_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['start_url_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Start URL'),
        '#default_value' => $config->get('start_url_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['display_' . $domain->id()] = [
        '#type'          => 'select',
        '#options'       => [
          'fullscreen' => $this->t('Fullscreen'),
          'standalone' => $this->t('Standalone'),
          'minimal-ui' => $this->t('Minimal UI'),
          'browser'    => $this->t('Browser'),
        ],
        '#title'         => $this->t('Display'),
        '#default_value' => $config->get('display_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['orientation_' . $domain->id()] = [
        '#type'          => 'select',
        '#options'       => [
          'portrait'  => $this->t('Portrait'),
          'landscape' => $this->t('Landscape'),
        ],
        '#title'         => $this->t('Orientation'),
        '#default_value' => $config->get('orientation_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['theme_color_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Theme Color'),
        '#default_value' => $config->get('theme_color_' . $domain->id()),
      ];

      $form['domain_settings_' . $domain->id()]['background_color_' . $domain->id()] = [
        '#type'          => 'textfield',
        '#title'         => $this->t('Background Color'),
        '#default_value' => $config->get('background_color_' . $domain->id()),
      ];
    }

    //    dsm($domains_list);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $domains_list = $this->getDomainList();

    foreach ($domains_list as $domain) {
      $this->config('domain_manifest.settings')
        ->set('name_' . $domain->id(), $form_state->getValue('name_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('short_name_' . $domain->id(), $form_state->getValue('short_name_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('description_' . $domain->id(), $form_state->getValue('description_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('start_url_' . $domain->id(), $form_state->getValue('start_url_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('display_' . $domain->id(), $form_state->getValue('display_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('orientation_' . $domain->id(), $form_state->getValue('orientation_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('theme_color_' . $domain->id(), $form_state->getValue('theme_color_' . $domain->id()))
        ->save();
      $this->config('domain_manifest.settings')
        ->set('background_color_' . $domain->id(), $form_state->getValue('background_color_' . $domain->id()))
        ->save();
    }

    parent::submitForm($form, $form_state);
  }

}
