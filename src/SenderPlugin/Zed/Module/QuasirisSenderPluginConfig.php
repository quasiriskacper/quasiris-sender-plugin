<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Quasiris\QuasirisSenderPlugin\Zed\Module;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Quasiris\QuasirisSenderPlugin\Zed\Module\Shared\QuasirisSenderPluginConstants;

class QuasirisSenderPluginConfig extends AbstractBundleConfig
{
    public function getMySetting(): array
    {
        return $this->get(QuasirisSenderPluginConstants::MY_SETTING);
    }
}