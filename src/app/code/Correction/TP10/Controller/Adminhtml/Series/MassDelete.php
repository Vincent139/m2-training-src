<?php
namespace Correction\TP10\Controller\Adminhtml\Series;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Correction\TP4\Model\ResourceModel\Series\CollectionFactory;
use Correction\TP9\Api\SeriesRepositoryInterface;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var SeriesRepositoryInterface
     */
    private $seriesRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param SeriesRepositoryInterface $seriesRepository
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        Context $context,
        SeriesRepositoryInterface $seriesRepository = null
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->seriesRepository = $seriesRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(SeriesRepositoryInterface::class);

        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $seriesDeleted = 0;
        foreach ($collection->getItems() as $series) {
            $this->seriesRepository->delete($series);
            $seriesDeleted++;
        }

        if ($seriesDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $seriesDeleted)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('formationtp10/*/index');
    }
}
