<?php

namespace Drupal\custom_entity\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Defines a custom constraint for price validation.
 *
 * @Constraint(
 *   id = "PriceConstraint",
 *   label = @Translation("Price constraint", context = "Validation")
 * )
 */
class PriceFieldConstraint extends Constraint {

  /**
   * To show the error line.
   * 
   * @var string
   */
  public $msg = 'Price must be greater than 100.';

}
