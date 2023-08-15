<?php

namespace Json\Api\controller\index;

use \Magento\Framework\App\Action\Action;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Webapi\Rest\Response;

class Goods extends Action
{
    private $response;
    private $productRepository;

    public function __construct(Context $context, Response $response,ProductRepositoryInterface $productRepository)
    {
        $this->response = $response;
        $this->productRepository = $productRepository;

        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $sku = $this->getRequest()->getParam("sku");
            if (!$sku){
                $return = [
                    "code" => 1,
                    "msg" => "参数异常",
                    "data" => []
                ];
            }else{
                $info = $this->productRepository->get($sku);
                $return = [
                    "code" => 0,
                    "msg" => "success",
                    "data" => [
                        "id" => $info->getId(),
                        "name" => $info->getName(),
                        "link" => $info->getProductLinks(),
                        "price" => $info->getPrice()
                    ]
                ];

            }

        }catch (\Exception $exception){
            $return = [
                "code" => 1,
                "msg" => "数据异常",
                "data" => []
            ];

        }
        return $this->response->setHttpResponseCode(200)->setContent(json_encode($return));
    }
}
