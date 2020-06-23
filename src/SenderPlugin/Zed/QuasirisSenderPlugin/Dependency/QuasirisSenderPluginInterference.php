<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Quasiris\Zed\QuasirisSenderPlugin\Dependency;

interface QuasirisSenderPluginInterference
{
    /**
     * Specification:
     * - Represents spy_product_bundle entity creation.
     *
     * @api
     */
    public const URL_TO_API = 'http://dev05.quasiris.de:8087/api/v1/data/spryker-demo';
    // public const URL_TO_API = 'http://192.168.100.50:8000/api/spryker/getData';
    public const URL_TO_API_MY_API = 'http://192.168.0.108:8000/api/spryker/responseQuasiris';
}
