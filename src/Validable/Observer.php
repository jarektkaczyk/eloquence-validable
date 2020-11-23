<?php

namespace Sofa\Eloquence\Validable;

use Sofa\Eloquence\Contracts\Validable;

class Observer
{
    /**
     * Validation skipping flag.
     *
     * @var integer
     */
    const SKIP_ONCE = 1;

    /**
     * Validation skipping flag.
     *
     * @var integer
     */
    const SKIP_ALWAYS = 2;

    /**
     * Halt creating if model doesn't pass validation.
     *
     * @param  \Sofa\Eloquence\Contracts\Validable $model
     * @return void|false
     */
    public function creating(Validable $model)
    {
        if ($model->validationEnabled() && !$model->isValid()) {
            return false;
        }
    }

    /**
     * Updating event handler.
     *
     * @param  \Sofa\Eloquence\Contracts\Validable $model
     * @return void|false
     */
    public function updating(Validable $model)
    {
        if ($model->validationEnabled() && !$model->isValid()) {
            return false;
        }
    }

    /**
     * Enable validation for the model if skipped only once.
     *
     * @param  \Sofa\Eloquence\Contracts\Validable $model
     * @return void
     */
    public function saved(Validable $model)
    {
        if ($model->skipsValidation() === static::SKIP_ONCE) {
            $model->enableValidation();
        }
    }
}
