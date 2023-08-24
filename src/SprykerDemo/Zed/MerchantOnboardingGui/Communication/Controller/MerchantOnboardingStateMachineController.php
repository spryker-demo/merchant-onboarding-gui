<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication\Controller;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerDemo\Zed\MerchantOnboardingGui\MerchantOnboardingGuiConfig;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\MerchantOnboardingGui\Communication\MerchantOnboardingGuiCommunicationFactory getFactory()
 */
class MerchantOnboardingStateMachineController extends AbstractController
{
    /**
     * @var string
     */
    protected const REQUEST_ID_MERCHANT = 'id-merchant';

    /**
     * @var string
     */
    protected const REQUEST_EVENT = 'event';

    /**
     * @var string
     */
    protected const REQUEST_ID_STATE_MACHINE_STATE = 'id_state_machine_state';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function triggerEventAction(Request $request): RedirectResponse
    {
        $idMerchant = $this->castId($request->get(static::REQUEST_ID_MERCHANT));
        $event = $request->get(static::REQUEST_EVENT);
        $idStateMachineState = $request->get(static::REQUEST_ID_STATE_MACHINE_STATE);

        $this->getFactory()->getStateMachineFacade()->triggerEvent(
            $event,
            (new StateMachineItemTransfer())->setIdentifier($idMerchant)
                ->setProcessName(MerchantOnboardingGuiConfig::PROCESS_NAME)
                ->setStateMachineName(MerchantOnboardingGuiConfig::STATEMACHINE_NAME)
                ->setIdItemState($idStateMachineState),
        );

        return $this->redirectResponse($request->headers->get('referer', static::URL_MERCHANT_LIST));
    }
}
