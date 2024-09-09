<?php
namespace App\Controller;

use App\Repository\InvoiceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceListController extends AbstractController
{
    public function index(Request $request, InvoiceRepository $invoiceRepository, PaginatorInterface $paginator): Response
    {
        $page = $request->query->getInt('page', 1);

        $pagination = $paginator->paginate(
            $invoiceRepository->createQueryBuilder('i')->getQuery(),
            $page,
            10
        );

        return $this->render('list.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}