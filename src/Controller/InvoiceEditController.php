<?php
namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceEditController extends AbstractController
{
    public function index(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $invoice = $form->getData();
            $invoice->updateTotalAmount();

            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('save.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }
}