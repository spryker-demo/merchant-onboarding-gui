<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication\Plugin;

use Spryker\Zed\MerchantGuiExtension\Dependency\Plugin\MerchantTableDataExpanderPluginInterface;

class MerchantOnboardingMerchantTableDataExpanderPlugin implements MerchantTableDataExpanderPluginInterface
{
    /**
     * @var string
     */
    public const COL_STATE = 'state';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $item
     *
     * @return array
     */
    public function expand(array $item): array
    {
        return [
             static::COL_STATE => $item[static::COL_STATE],
        ];
    }
}
