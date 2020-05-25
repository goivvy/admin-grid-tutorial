<?php
namespace Dev\Grid\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Exception\NotFoundException;

class MassDelete extends Action
{

    const ADMIN_RESOURCE = 'Magento_Catalog::categories';

    protected $filter;

    protected $collectionFactory;

    private $categoryRepository;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CategoryRepositoryInterface $categoryRepository = null
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->categoryRepository = $categoryRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(CategoryRepositoryInterface::class);
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $categoryDeleted = 0;
        foreach ($collection->getItems() as $category) {
            $this->categoryRepository->delete($category);
            $categoryDeleted++;
        }

        if ($categoryDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $categoryDeleted)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('dev_grid/index/index');
    }
}
