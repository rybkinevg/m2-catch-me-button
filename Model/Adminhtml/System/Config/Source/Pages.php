<?php
/**
 * CyberHULL_CatchMeButton
 *
 * @copyright Copyright (c) 2021 Alpine Consulting, Inc (www.alpineinc.com)
 * @author    Evgeniy Rybkin <evgeniy.rybkin@cyberhull.com>
 */

declare(strict_types=1);

namespace CyberHULL\CatchMeButton\Model\Adminhtml\System\Config\Source;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Pages
 */
class Pages implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $pageCollectionFactory;

    /**
     * Class constructor
     *
     * @param CollectionFactory $pageCollectionFactory
     */
    public function __construct(CollectionFactory $pageCollectionFactory)
    {
        $this->pageCollectionFactory = $pageCollectionFactory;
    }

    /**
     * Returns CMS pages options array
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $options = [];

        $collection = $this->pageCollectionFactory->create();

        $collection->addFieldToFilter(
            PageInterface::IS_ACTIVE,
            Page::STATUS_ENABLED
        );

        foreach ($collection->getItems() as $page) {
            $options[] = [
                'value' => $page->getData(PageInterface::IDENTIFIER),
                'label' => $page->getData(PageInterface::TITLE)
            ];
        }

        return $options;
    }
}
