<?php
namespace Dev\Grid\Ui\DataProvider\Category\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{

      protected function _initSelect()
      {
          $this->addFilterToMap('entity_id', 'main_table.entity_id');
          $this->addFilterToMap('name', 'devgridname.value');
          parent::_initSelect();
      }
}
