<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Resa extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Cette chambre "{{ chambre }}" n\'est pas disponible le {{ date }}. Veuillez choisir d\'autres dates ou une autre chambre';
}
