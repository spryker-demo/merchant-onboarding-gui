<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use SprykerDemo\Zed\MerchantOnboardingGui\MerchantOnboardingGuiDependencyProvider;

class MerchantOnboardingGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    public function getStateMachineFacade(): StateMachineFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingGuiDependencyProvider::FACADE_STATE_MACHINE);
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    public function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantOnboardingGuiDependencyProvider::FACADE_MERCHANT);
    }
}
