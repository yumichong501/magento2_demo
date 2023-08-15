<?php

namespace Json\Api\controller\admin;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Goods extends Action
{

    public function __construct(Context $context)
    {

        parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        echo "test";
        exit;
    }
}
