<?php
/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 CyberHULL (https://www.cyberhull.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

declare(strict_types=1);

namespace CyberHULL\CatchMeButton\Model\Checkout;

use CyberHULL\CatchMeButton\Model\Adminhtml\Config as AdminConfiguration;
use CyberHULL\CatchMeButton\Model\Adminhtml\System\Config\Source\Actions;
use Magento\Checkout\Model\ConfigProviderInterface;

/**
 * Class ConfigProvider
 */
class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @var AdminConfiguration
     */
    private $adminConfig;

    /**
     * Class constructor
     *
     * @param AdminConfiguration $adminConfig
     */
    public function __construct(AdminConfiguration $adminConfig)
    {
        $this->adminConfig = $adminConfig;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig(): array
    {
        return [
            'catchMeButtonData' => [
                'isModuleEnable'    => $this->adminConfig->isModuleEnable(),
                'buttonPhrases'     => $this->adminConfig->getButtonPhrases(),
                'clickedActionType' => $this->getClickedActionType(),
                'clickedAction'     => $this->getClickedAction(),
            ]
        ];
    }

    /**
     * Returns clicked action type
     *
     * @return string|null
     */
    private function getClickedActionType(): ?string
    {
        $clickedActionOption = $this->adminConfig->getClickedAction();

        switch ($clickedActionOption) {
            case Actions::CUSTOM_REDIRECT:
                $clickedActionType = Actions::REDIRECT;

                break;
            case Actions::REDIRECT:
                $clickedActionType = Actions::REDIRECT;

                break;

            case Actions::EXCEPTION:
                $clickedActionType = Actions::EXCEPTION;

                break;

            default:
                $clickedActionType = null;

                break;
        }

        return $clickedActionType;
    }

    /**
     * Returns clicked action
     *
     * @return string|null
     */
    private function getClickedAction(): ?string
    {
        $clickedActionOption = $this->adminConfig->getClickedAction();

        switch ($clickedActionOption) {
            case Actions::CUSTOM_REDIRECT:
                $clickedAction = $this->adminConfig->getCustomRedirectActionUrl();

                break;

            case Actions::REDIRECT:
                $clickedAction = $this->adminConfig->getRedirectActionUrl();

                break;

            case Actions::EXCEPTION:
                $clickedAction = $this->adminConfig->getExceptionActionMessage();

                break;

            default:
                $clickedAction = null;

                break;
        }

        return $clickedAction;
    }
}
