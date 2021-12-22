<?php
/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 Alpine Consulting, Inc (www.alpineinc.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

declare(strict_types=1);

namespace CyberHULL\CatchMeButton\Model\Adminhtml;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 */
class Config
{
    /**
     * Is module enable
     *
     * @var string
     */
    public const XML_PATH_MODULE_ENABLE = 'ch_catch_me_button/general/enable';

    /**
     * Button phrases
     *
     * @var string
     */
    public const XML_PATH_BUTTON_PHRASES = 'ch_catch_me_button/general/button_phrases';

    /**
     * Clicked action
     *
     * @var string
     */
    public const XML_PATH_CLICKED_ACTION = 'ch_catch_me_button/checkout/clicked_action';

    /**
     * Custom redirect action URL
     *
     * @var string
     */
    public const XML_PATH_ACTION_CUSTOM_REDIRECT = 'ch_catch_me_button/checkout/custom_redirect';

    /**
     * Redirect action URL
     *
     * @var string
     */
    public const XML_PATH_ACTION_REDIRECT = 'ch_catch_me_button/checkout/redirect';

    /**
     * Exception action message
     *
     * @var string
     */
    public const XML_PATH_ACTION_EXCEPTION = 'ch_catch_me_button/checkout/exception';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Class constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param SerializerInterface  $serializer
     * @param UrlInterface         $urlBuilder
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        SerializerInterface  $serializer,
        UrlInterface         $urlBuilder
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->serializer  = $serializer;
        $this->urlBuilder  = $urlBuilder;
    }

    /**
     * Checks is module enable
     *
     * @param null|int|string $scopeCode
     *
     * @return bool
     */
    public function isModuleEnable($scopeCode = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_MODULE_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Returns button phrases, otherwise null
     *
     * @param  null|int|string $scopeCode
     *
     * @return null|array
     */
    public function getButtonPhrases($scopeCode = null): ?array
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_BUTTON_PHRASES,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );

        if ($value && !is_array($value)) {
            try {
                $value = $this->serializer->unserialize($value);
            } catch (Exception $e) {
                $value = null;
            }
        }

        return $value;
    }

    /**
     * Returns clicked action
     *
     * @param  null|int|string $scopeCode
     *
     * @return null|string
     */
    public function getClickedAction($scopeCode = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CLICKED_ACTION,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Returns custom redirect action URL
     *
     * @param  null|int|string $scopeCode
     *
     * @return null|string
     */
    public function getCustomRedirectActionUrl($scopeCode = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ACTION_CUSTOM_REDIRECT,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Returns redirect action URL
     *
     * @param  null|int|string $scopeCode
     *
     * @return null|string
     */
    public function getRedirectActionUrl($scopeCode = null): ?string
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_ACTION_REDIRECT,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );

        return $value
            ? $this->urlBuilder->getRouteUrl($value)
            : null;
    }

    /**
     * Returns exception action message
     *
     * @param  null|int|string $scopeCode
     *
     * @return null|string
     */
    public function getExceptionActionMessage($scopeCode = null): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ACTION_EXCEPTION,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }
}
