<?php
namespace Correction\TP6ter\Block\Product;

use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\View as MageView;
use Magento\Catalog\Block\Product\Context;

class View extends MageView
{
    /** @var CollectionFactory */
    protected $vendorCollectionFactory;

    public function __construct(
        CollectionFactory $vendorCollectionFactory,
        Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->vendorCollectionFactory = $vendorCollectionFactory;

        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig,
            $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }

    /**
     * Get vendors associated to product.
     *
     * @return array
     */
    public function getVendors()
    {
        $result = [];

        $productId = $this->getProduct()->getId();

        if ($productId) {
            $vendorCollection = $this->vendorCollectionFactory->create();
            $connection = $vendorCollection->getConnection();
            $select = $connection->select()->from(
                'tp4_catalog_product_vendor',
                [ 'vendor_id ']
            )->where(
                'product_id = :product_id'
            );
            $vendorIds = $connection->fetchCol($select, [':product_id' => $productId]);
            $vendors = $vendorCollection->addFieldToFilter('vendor_id', [ 'in' => $vendorIds]);
            foreach ($vendors->getItems() as $vendor) {
                $result[] = $vendor->getName();
            }
        }

        return $result;
    }
}
