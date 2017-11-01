<?php

namespace SinglehopLlc\Base\InterfaceBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package SinglehopLlc\Base\InterfaceBundle\Controller
 */
class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        return new JsonResponse(
            [
                'status' => Response::HTTP_OK,
                'name' => $this->container->getParameter('app.name'),
                "version" => ["api" => "v" . $this->container->getParameter('current.api.version')]
            ]
        );
    }
}
