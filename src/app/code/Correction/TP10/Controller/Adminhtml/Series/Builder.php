<?php
declare(strict_types=1);

namespace Correction\TP10\Controller\Adminhtml\Series;

use Correction\TP9\Api\Data\SeriesInterface;
use Correction\TP9\Api\Data\SeriesInterfaceFactory;
use Magento\Cms\Model\Wysiwyg as WysiwygModel;
use Magento\Framework\App\RequestInterface;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Registry;
use Correction\TP9\Api\SeriesRepositoryInterface;

/**
 * Build a series based on a request
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Builder
{
    /**
     * @var SeriesInterfaceFactory
     */
    protected $seriesFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $wysiwygConfig;

    /**
     * @var SeriesRepositoryInterface
     */
    private $seriesRepository;

    /**
     * Builder constructor.
     *
     * @param SeriesInterfaceFactory $seriesFactory
     * @param Logger $logger
     * @param Registry $registry
     * @param WysiwygModel\Config $wysiwygConfig
     * @param SeriesRepositoryInterface|null $seriesRepository
     */
    public function __construct(
        SeriesInterfaceFactory $seriesFactory,
        Logger $logger,
        Registry $registry,
        WysiwygModel\Config $wysiwygConfig,
        SeriesRepositoryInterface $seriesRepository = null
    ) {
        $this->seriesFactory = $seriesFactory;
        $this->logger = $logger;
        $this->registry = $registry;
        $this->wysiwygConfig = $wysiwygConfig;
        $this->seriesRepository = $seriesRepository ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(SeriesRepositoryInterface::class);
    }

    /**
     * Build series based on user request
     *
     * @param RequestInterface $request
     * @return SeriesInterface
     * @throws \RuntimeException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function build(RequestInterface $request): SeriesInterface
    {
        $seriesId = (int) $request->getParam('id');

        if ($seriesId) {
            $series = $this->seriesRepository->get($seriesId);
        } else {
            $series = $this->seriesFactory->create();
        }

        $this->registry->register('series', $series);
        $this->registry->register('current_series', $series);

        return $series;
    }
}
