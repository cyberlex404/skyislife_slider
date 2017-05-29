<?php

namespace Drupal\skyislife_slider\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SkySliderForm.
 *
 * @package Drupal\skyislife_slider\Form
 */
class SkySliderForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /**
     * @var $sky_slider \Drupal\skyislife_slider\Entity\SkySliderInterface
     */
    $sky_slider = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $sky_slider->label(),
      '#description' => $this->t("Label for the Sky slider."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $sky_slider->id(),
      '#machine_name' => [
        'exists' => '\Drupal\skyislife_slider\Entity\SkySlider::load',
      ],
      '#disabled' => !$sky_slider->isNew(),
    ];

    $form['image'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image path'),
      '#maxlength' => 255,
      '#default_value' => $sky_slider->getImage(),
      '#description' => $this->t("Path to slider image."),
      '#required' => TRUE,
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $sky_slider = $this->entity;
    $status = $sky_slider->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Sky slider.', [
          '%label' => $sky_slider->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Sky slider.', [
          '%label' => $sky_slider->label(),
        ]));
    }
    $form_state->setRedirectUrl($sky_slider->toUrl('collection'));
  }

}
