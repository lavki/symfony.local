<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\FilterForm;
use App\DTO\FilterFormDTO;
use App\Repository\ReportRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReportController extends AbstractController
{
    /**
     * @Route("/", name="app_report")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(FilterForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var ReportRepository $repo */
            $repo = $entityManager->getRepository(Report::class);
            $report = $repo->findByFilter(new FilterFormDTO(...$form->getData()));
        } else {
            $report = $this->getDoctrine()->getRepository(Report::class)->findAll();
        }


        return $this->render('report.html.twig', [
            'form' => $form->createView(),
            'reports' => $report,
        ]);
    }
}