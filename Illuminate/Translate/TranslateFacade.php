<?php

namespace App\Illuminate\Translate;

use Illuminate\Support\Facades\Facade;


class TranslateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'translate';
    }
}
