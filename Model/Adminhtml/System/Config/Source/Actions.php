<?php
/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 Alpine Consulting, Inc (www.alpineinc.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

declare(strict_types=1);

namespace CyberHULL\CatchMeButton\Model\Adminhtml\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Actions
 */
class Actions implements OptionSourceInterface
{
    /**
     * Place order action value
     *
     * @var string
     */
    public const PLACE_ORDER = 'placeOrder';

    /**
     * Redirect action value
     *
     * @var string
     */
    public const REDIRECT = 'redirect';

    /**
     * Custom redirect action value
     *
     * @var string
     */
    public const CUSTOM_REDIRECT = 'customRedirect';

    /**
     * Exception action value
     *
     * @var string
     */
    public const EXCEPTION = 'exception';

    /**
     * Returns action options array
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::PLACE_ORDER,
                'label' => __('Place Order')
            ],
            [
                'value' => self::REDIRECT,
                'label' => __('Redirect')
            ],
            [
                'value' => self::CUSTOM_REDIRECT,
                'label' => __('Custom Redirect')
            ],
            [
                'value' => self::EXCEPTION,
                'label' => __('Throw Exception')
            ],
        ];
    }
}
