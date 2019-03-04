<?php

namespace Badge\BadgeLabel\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class AllowedBadgeLabels extends AbstractSource
{
    public function getAllOptions()
    {
        return [
            'badge1' => [
                'label' => 'Sale', //подпись на странице
                'value' => 'sale' //значение в беке
            ],
            'badge2' => [
                'label' => 'Free Shipping',
                'value' => 'free_shipping'
            ],
            'badge3' => [
                'label' => 'Best Seller',
                'value' => 'best_seller'
            ]
        ];
    }
}