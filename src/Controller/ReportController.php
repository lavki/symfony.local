<?php

namespace App\Controller;

use App\Entity\Report;
use App\Service\Filter;
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
        $reportRepository = $this->getDoctrine()->getRepository(Report::class);

        return $this->render('report.html.twig', [
            'reports' => $reportRepository->findAll(),
            //'reports' => $reportRepository->findByFilter(),
            'locations' => Filter::getLocation(),
        ]);
    }
    
    private function insertDataToDB() {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $this->getMockData();
        foreach ($data as $item) {
            $report = new Report();
            $report->setName($item['name']);
            $report->setDate($item['date']);
            $report->setPerson($item['person']);
            $report->setLocation($item['location']);

            $entityManager->persist($report);
            $entityManager->flush();
        }
    }
    
    private function getMockData(): array {
        $date = [
            [
                'name' => 'Nazva #1',
                'date' => new \DateTime('2022-02-23 09:00:00'),
                'person' => 'Adam',
                'location' => 'Lodz',
            ],
            [
                'name' => 'Nazva #2',
                'date' => new \DateTime('2022-04-11 12:00:00'),
                'person' => 'John',
                'location' => 'New York',
            ],
            [
                'name' => 'Nazva #3',
                'date' => new \DateTime(date('Y-m-d H:i:s')),
                'person' => 'Mykolay',
                'location' => 'Kyiv',
            ],
            [
                'name' => 'Nazva #4',
                'date' => new \DateTime(date('Y-m-d H:i:s')),
                'person' => 'James',
                'location' => 'London',
            ],
            [
                'name' => 'Nazva #5',
                'date' => new \DateTime('2022-01-01 17:46:34'),
                'person' => 'Andrea',
                'location' => 'Roma',
            ],
            [
                'name' => 'Nazva #6',
                'date' => new \DateTime('2022-04-01 17:46:32'),
                'person' => 'Alex',
                'location' => 'Lodz',
            ],
            [
                'name' => 'Nazva #7',
                'date' => new \DateTime('2022-03-28 14:55:46'),
                'person' => 'Smith',
                'location' => 'Stockholm',
            ],
            [
                'name' => 'Nazva #8',
                'date' => new \DateTime(date('Y-m-d H:i:s')),
                'person' => 'Kinga',
                'location' => 'Lodz',
            ],
            [
                'name' => 'Nazva #9',
                'date' => new \DateTime('2022-04-11 22:10:00'),
                'person' => 'Orest',
                'location' => 'Lviv',
            ],
            [
                'name' => 'Nazva #10',
                'date' => new \DateTime('2022-04-11 14:00:47'),
                'person' => 'Igor',
                'location' => 'Kyiv',
            ],
        ];
        
        return $date;
    }
}
