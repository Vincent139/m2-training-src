<?php
namespace Correction\TP2\Controller;

use Magento\Framework\App\HttpRequestInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ActionInterface;

class Router implements \Magento\Framework\App\RouterInterface
{
    /** @var \Magento\Framework\App\ActionFactory */
    protected $actionFactory;

    /**
     * Router constructor.
     *
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match corresponding URL Rewrite and modify request.
     *
     * @param HttpRequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        switch (explode('/', $request->getPathInfo())[1]) {
            case 'test1':
                $request->setPathInfo(
                    preg_replace(
                        '#test1(/.*)?#',
                        'formationtp2/json/test1$1',
                        $request->getPathInfo()
                    )
                );
                return $this->actionFactory->create(
                    \Magento\Framework\App\Action\Forward::class
                );

            case 'test2':
                $request->setPathInfo(
                    preg_replace(
                        '#test2(/.*)?#',
                        'formationtp2/json/test2$1',
                        $request->getPathInfo()
                    )
                );
                return $this->actionFactory->create(
                    \Magento\Framework\App\Action\Forward::class
                );

            default:
                return null;
        }
    }
}
