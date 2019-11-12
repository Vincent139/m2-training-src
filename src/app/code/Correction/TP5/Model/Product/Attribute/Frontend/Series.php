<?php
namespace Correction\TP5\Model\Product\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Store\Model\StoreManagerInterface;
use Correction\TP4\Model\Series as SeriesModel;
use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResourceModel;

class Series extends AbstractFrontend
{
    /** @var SeriesFactory */
    protected $seriesFactory;

    /** @var SeriesResourceModel */
    protected $seriesResourceModel;

    /**
     * Series constructor.
     *
     * @param SeriesFactory $seriesFactory
     * @param SeriesResourceModel $seriesResourceModel
     * @param BooleanFactory $attrBooleanFactory
     * @param CacheInterface|null $cache
     * @param null $storeResolver
     * @param array|null $cacheTags
     * @param StoreManagerInterface|null $storeManager
     * @param Serializer|null $serializer
     */
    public function __construct(
        SeriesFactory $seriesFactory,
        SeriesResourceModel $seriesResourceModel,
        BooleanFactory $attrBooleanFactory,
        CacheInterface $cache = null,
        $storeResolver = null,
        array $cacheTags = null,
        StoreManagerInterface $storeManager = null,
        Serializer $serializer = null
    ) {
        $this->seriesFactory = $seriesFactory;
        $this->seriesResourceModel = $seriesResourceModel;

        parent::__construct($attrBooleanFactory, $cache, $storeResolver, $cacheTags, $storeManager, $serializer);
    }

    /**
     * @inheritDoc
     */
    public function getOption($optionId)
    {
        $result = parent::getOption($optionId);

        if ($result !== false) {
            /** @var SeriesModel $model */
            $model = $this->seriesFactory->create();
            $this->seriesResourceModel->load($model, $optionId);
            $result .= ' - '.$model->getColor();
        }

        return $result;
    }
}
