<?php
 
namespace Gaggle\Cartcreator\Block\Adminhtml\Cart\Renderer;
 
use Magento\Framework\DataObject;
 
class Link extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    
    protected $urlManager;
    
    public function __construct(
        \Magento\Framework\Url $urlManager
    ) {
        $this->urlManager = $urlManager;
    }
    
    /**
     * get category name
     * @param  DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = $row->getId();
        $url = $this->urlManager->getUrl('cartcreator/index/index',['id'=>$id,'_nosid' => true ]);
        return $url;
    }
}