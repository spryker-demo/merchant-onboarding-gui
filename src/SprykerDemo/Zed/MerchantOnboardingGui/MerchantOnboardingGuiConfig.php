<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantOnboardingGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class MerchantOnboardingGuiConfig extends AbstractBundleConfig
{
    /**
     * @uses {@link \SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_PROCESS_NAME}
     *
     * @var string
     */
    public const PROCESS_NAME = 'MerchantOnboardingStateMachine';

    /**
     * @uses {@link \SprykerDemo\Zed\MerchantOnboardingStateMachine\MerchantOnboardingStateMachineConfig::MERCHANT_ONBOARDING_STATE_MACHINE_NAME}
     *
     * @var string
     */
    public const STATEMACHINE_NAME = 'MerchantOnboarding';

    /**
     * @uses {@link \Spryker\Zed\MerchantGui\MerchantGuiConfig::URL_MERCHANT_LIST}
     *
     * @var string
     */
    public const URL_MERCHANT_LIST = '/merchant-gui/list-merchant';
}
