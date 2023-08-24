<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication\Plugin;

use Spryker\Zed\MerchantGuiExtension\Dependency\Plugin\MerchantTableHeaderExpanderPluginInterface;

class MerchantOnboardingMerchantTableHeaderExpanderPlugin implements MerchantTableHeaderExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const COL_STATE = 'state';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function expand(): array
    {
        return [
            static::COL_STATE => 'Onboarding Status',
            ];
    }
}
