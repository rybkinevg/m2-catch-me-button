<?php
/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 Alpine Consulting, Inc (www.alpineinc.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

declare(strict_types=1);

namespace CyberHULL\CatchMeButton\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class ButtonPhrases
 */
class ButtonPhrases extends AbstractFieldArray
{
    /**
     * Column name
     *
     * @var string
     */
    public const COLUMN_NAME = 'phrase';

    /**
     * Column label
     *
     * @var string
     */
    public const COLUMN_LABEL = 'Phrase';

    /**
     * {@inheritDoc}
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            self::COLUMN_NAME,
            [
                'label' => __(self::COLUMN_LABEL),
                'class' => 'required-entry letters-with-basic-punc',
            ]
        );

        $this->_addAfter = false;

        $this->_addButtonLabel = __('Add');
    }
}
