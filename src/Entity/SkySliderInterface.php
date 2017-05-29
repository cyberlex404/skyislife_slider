<?php

namespace Drupal\skyislife_slider\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Sky slider entities.
 */
interface SkySliderInterface extends ConfigEntityInterface {

  public function getImage();

  public function setImage(string $image);

}
