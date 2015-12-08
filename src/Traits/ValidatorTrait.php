<?php
/**
 * Part of the Caffeinated PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Docit\Support\Traits;

use Docit\Support\Contracts\Validator;

trait ValidatorTrait
{
    /**
     * The Validator instance.
     *
     * @var \Cartalyst\Support\Validator
     */
    protected $validator;

    /**
     * Returns the Validator instance.
     *
     * @return \Docit\Support\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Sets the Validator instance.
     *
     * @param  \Docit\Support\Validator  $validator
     * @return $this
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
