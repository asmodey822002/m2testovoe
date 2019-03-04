<?php
namespace Badge\BadgeLabel\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{
    private $_eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(Product::ENTITY, 'badge_label');

        $eavSetup->addAttribute(
            Product::ENTITY,
            'badge_label',//програмное имя атрибута для обращения в коде
            [
                'type' => 'text',// или varchar
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend', //модель magento для multiselect аттрибута. Если ее не указать, то аттрибут появится в админке, но значение этого аттрибута не будет сохраняться.
                'source' => 'Badge\BadgeLabel\Model\Entity\Attribute\Source\AllowedBadgeLabels',//модель в кастомном модуле, в которой указаны значения. Удобство в том, что значения можно изменить после того как отработает код создания аттрибута.
                'frontend' => '',//
                'label' => 'Badge Label',//имя атрибута для показа на страницах
                'input' => 'multiselect',//форма ввода в админке
                'class' => '',//
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,//где показывать
                'visible' => true,//
                'required' => true,// обязательный или нет (true / false)
                'user_defined' => false,
                'default' => '',//значение по умолчанию
                'searchable' => true,//участвует ли в поиске
                'filterable' => true,//участвует ли в фильтрах слева на стр. категорий
                'comparable' => true,//доступность для сравнения
                'visible_on_front' => false,//
                'used_in_product_listing' => true,//
                'unique' => false,//уникальность
                'apply_to' => ''//хз
            ]
        );


        $setup->endSetup();
    }
}