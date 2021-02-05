<?php

namespace Chargeafter\Payment\Model\Config\Source;

class Logo implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => '',
                'label' => 'No Image',
            ],
            [
                'value' => 'Btn_CA',
                'label' => 'Btn_CA'
            ],
            [
                'value' => 'Btn_CF',
                'label' => 'Btn_CF'
            ],
            [
                'value' => 'Btn_SatisFi',
                'label' => 'Btn_SatisFi'
            ]
        ];
    }
}
