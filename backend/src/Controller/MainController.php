<?php

namespace App\Controller;

use App\Form\PriceCalculatorType;
use App\Service\ProductPriceCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('')]
    public function index(
        ProductPriceCalculator $productPriceCalculator,
        Request $request
    ): Response
    {
        $form = $this->createForm(PriceCalculatorType::class);
        $form->handleRequest($request);

        $resultPrice = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData()['product'];
            $taxNumber = $form->getData()['taxNumber'];
            $resultPrice = $productPriceCalculator->getPriceByTaxNumber($product, $taxNumber);
        }

        return $this->render('index.html.twig', [
            'form' => $form,
            'resultPrice' => $resultPrice,
        ]);
    }
}