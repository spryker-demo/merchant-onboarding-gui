<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication\Controller;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerDemo\Zed\MerchantOnboardingGui\MerchantOnboardingGuiConfig;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\MerchantOnboardingGui\Communication\MerchantOnboardingGuiCommunicationFactory getFactory()
 */
class RenderViewController extends AbstractController
{
    /**
     * @var string
     */
    protected const REQUEST_ID_MERCHANT = 'id-merchant';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function onboardingAction(Request $request): array
    {
        $idMerchant = $this->castId($request->get(static::REQUEST_ID_MERCHANT));
        $merchantTransfer = $this->getFactory()->getMerchantFacade()->findOne((new MerchantCriteriaTransfer())->setIdMerchant($idMerchant));
        $stateHistory = [];
        $stateMachineManualEvents = '';

        if (!$merchantTransfer) {
            return [];
        }

        $applicableMerchantStatuses = $this->getFactory()->getMerchantFacade()->getApplicableMerchantStatuses($merchantTransfer->getStatus());

        if (!$merchantTransfer->getStateMachineItem()) {
            return [];
        }

        $stateMachineManualEvents = $this->getFactory()->getStateMachineFacade()->getManualEventsForStateMachineItem(
            (new StateMachineItemTransfer())
                ->setProcessName(MerchantOnboardingGuiConfig::PROCESS_NAME)
                ->setStateMachineName(MerchantOnboardingGuiConfig::STATEMACHINE_NAME)
                ->setStateName($merchantTransfer->getStateMachineItem()->getStateName()),
        );

        $stateHistory = $this->getFactory()->getStateMachineFacade()->getStateHistoryByStateItemIdentifier(
            $merchantTransfer->getStateMachineItem()->getIdStateMachineProcess(),
            $merchantTransfer->getIdMerchant(),
        );

        return $this->viewResponse([
            'idMerchant' => $idMerchant,
            'stateHistory' => $stateHistory,
            'detectedScore' => $merchantTransfer->getDetectedScore(),
            'stateMachineItemTransfer' => $merchantTransfer->getStateMachineItem(),
            'stateMachineManualEvents' => $stateMachineManualEvents,
            'applicableMerchantStatuses' => $applicableMerchantStatuses,
        ]);
    }
}
