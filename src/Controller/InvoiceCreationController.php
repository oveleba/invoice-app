<?php
namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Service\InvoiceNumberGenerator;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InvoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceCreationController extends AbstractController
{
    public function __construct(
        private InvoiceNumberGenerator $invoiceNumberGenerator,
    )
    {
    }

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice->setInvoiceNumber($this->invoiceNumberGenerator->generateInvoiceNumber($invoice->getIssueDate()));
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