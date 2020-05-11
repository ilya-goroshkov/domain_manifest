<?php

namespace Drupal\domain_manifest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Provides route responses for the Example module.
 */
class DomainManifest extends ControllerBase {

  /**
   * Returns a manifest file contains.
   *
   * @return JsonResponse
   *   JSON array with file contains.
   */
  public function manifestFile() {
    $module_path = drupal_get_path('module', 'domain_manifest');

    $domain_id = domain_entity_get_domain()->id();
    $config    = \Drupal::config('domain_manifest.settings');

    $icons = [
      [
        "src"   => $module_path . "/images/icons/icon-72x72.png",
        "sizes" => "72x72",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-96x96.png",
        "sizes" => "96x96",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-128x128.png",
        "sizes" => "128x128",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-144x144.png",
        "sizes" => "144x144",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-152x152.png",
        "sizes" => "152x152",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-192x192.png",
        "sizes" => "192x192",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-384x384.png",
        "sizes" => "384x384",
        "type"  => "image/png",
      ],
      [
        "src"   => $module_path . "/images/icons/icon-512x512.png",
        "sizes" => "512x512",
        "type"  => "image/png",
      ],
    ];

    \Drupal::moduleHandler()
      ->invokeAll('domain_manifest_icons_alter', [&$icons]);

    $manifest = [
      'name'             => $config->get('name_' . $domain_id),
      'short_name'       => $config->get('short_name_' . $domain_id),
      'description'      => $config->get('description_' . $domain_id),
      'start_url'        => $config->get('start_url_' . $domain_id),
      'display'          => $config->get('display_' . $domain_id),
      'orientation'      => $config->get('orientation_' . $domain_id),
      'theme_color'      => $config->get('theme_color_' . $domain_id),
      'background_color' => $config->get('background_color_' . $domain_id),
      "icons"            => $icons,
    ];

    return new JsonResponse($manifest);
  }

}
