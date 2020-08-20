<?php

namespace App\Controller\Web;

use App\Service\ShipmentCostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
   /**
    * @Route("/")
    */
    public function index(ShipmentCostService $shipmentCostService): Response
    {
        $products = $shipmentCostService->orderProductsShippingCostBySupplier();

        return $this->render('home/index.html.twig', compact('products'));
    }
}