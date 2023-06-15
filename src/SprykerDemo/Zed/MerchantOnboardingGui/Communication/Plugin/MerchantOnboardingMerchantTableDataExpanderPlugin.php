<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication\Plugin;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MerchantGuiExtension\Dependency\Plugin\MerchantTableDataExpanderPluginInterface;

/**
 * @method \SprykerDemo\Zed\MerchantOnboardingGui\Communication\MerchantOnboardingGuiCommunicationFactory getFactory()
 */
class MerchantOnboardingMerchantTableDataExpanderPlugin extends AbstractPlugin implements MerchantTableDataExpanderPluginInterface
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
             static::COL_STATE => $this->getStateMachineItemState($item),
        ];
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function getStateMachineItemState(array $item): string
    {
        $stateMachineItemTransfer = new StateMachineItemTransfer();
        $stateMachineItemTransfer->setIdItemState($item[SpyMerchantTableMap::COL_FK_STATE_MACHINE_ITEM_STATE]);
        $stateMachineItemTransfer->setIdentifier($item[SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS]);

        $stateMachineItemTransfer = $this->getFactory()->getStateMachineFacade()->getProcessedStateMachineItemTransfer($stateMachineItemTransfer);

        return $stateMachineItemTransfer->getStateName();
    }
}
