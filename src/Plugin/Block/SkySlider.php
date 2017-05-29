<?php

namespace Drupal\skyislife_slider\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Config\ConfigFactory;

/**
 * Provides a 'SkySlider' block.
 *
 * @Block(
 *  id = "sky_slider",
 *  admin_label = @Translation("Sky slider"),
 * )
 */
class SkySlider extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManager definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;
  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;
  /**
   * Constructs a new SkySlider object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        EntityTypeManager $entity_type_manager, 
	ConfigFactory $config_factory
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
    $this->configFactory = $config_factory;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
         'count_slide' => 0,
        ] + parent::defaultConfiguration();

 }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['count_slide'] = [
      '#type' => 'number',
      '#title' => $this->t('Count slide'),
      '#description' => $this->t(''),
      '#default_value' => $this->configuration['count_slide'],
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['count_slide'] = $form_state->getValue('count_slide');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    /**
     * @var $slides \Drupal\skyislife_slider\Entity\SkySliderInterface[]
     */
    $slides = $this->entityTypeManager->getStorage('sky_slider')->loadMultiple();
    foreach ($slides as $slide) {
      /**
       * @var $slide  \Drupal\skyislife_slider\Entity\SkySliderInterface
       */
      $build['sky_sliders'][$slide->id()]['#markup'] = '<p>' . $slide->getImage() . '  ' . $slide->label() .  '</p>';
    }


    return $build;
  }

}
