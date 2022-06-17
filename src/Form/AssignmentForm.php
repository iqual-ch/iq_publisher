<?php

namespace Drupal\iq_publisher\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Form controller for Assignment edit forms.
 *
 * @ingroup iq_publisher
 */
class AssignmentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iq_publisher\Entity\Assignment */
    $form = parent::buildForm($form, $form_state);
    $nid = \Drupal::request()->query->get('node');
    if (is_numeric($nid) ) {
      $node = Node::load($nid);
      $form['node']['widget'][0]['target_id']['#default_value'] = $node;
      $form['node']['widget'][0]['#disabled'] = true;
    }
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the assignment.'));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the assignment.'));
    }
    $node = $form_state->getValue('node');
    $form_state->setRedirect('entity.assignment.add_page', ['node' => $node[0]['target_id']]);
  }

}
