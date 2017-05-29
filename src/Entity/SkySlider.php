<?php

namespace Drupal\skyislife_slider\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Sky slider entity.
 *
 * @ConfigEntityType(
 *   id = "sky_slider",
 *   label = @Translation("Sky slider"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\skyislife_slider\SkySliderListBuilder",
 *     "form" = {
 *       "add" = "Drupal\skyislife_slider\Form\SkySliderForm",
 *       "edit" = "Drupal\skyislife_slider\Form\SkySliderForm",
 *       "delete" = "Drupal\skyislife_slider\Form\SkySliderDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\skyislife_slider\SkySliderHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "sky_slider",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/sky_slider/{sky_slider}",
 *     "add-form" = "/admin/structure/sky_slider/add",
 *     "edit-form" = "/admin/structure/sky_slider/{sky_slider}/edit",
 *     "delete-form" = "/admin/structure/sky_slider/{sky_slider}/delete",
 *     "collection" = "/admin/structure/sky_slider"
 *   }
 * )
 */
class SkySlider extends ConfigEntityBase implements SkySliderInterface {

  /**
   * The Sky slider ID.
   *
   * @var string
   */
  protected $id;

  /**
   * @var string
   */
  protected $image;

  /**
   * The Sky slider label.
   *
   * @var string
   */
  protected $label;

  public function getImage() {
    return $this->image;
  }

  public function setImage(string $image) {
    $this->image = $image;
  }


}
