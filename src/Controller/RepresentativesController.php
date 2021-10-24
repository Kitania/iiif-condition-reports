<?php

namespace App\Controller;

use App\Entity\DatahubData;
use App\Entity\InventoryNumber;
use App\Entity\Organisation;
use App\Entity\Report;
use App\Entity\Representative;
use App\Utils\IIIFUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RepresentativesController extends AbstractController
{
    /**
     * @Route("/{_locale}/representatives", name="representatives")
     */
    public function representatives(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager();

        $searchResults = array();
        $representatives = $em->createQueryBuilder()
            ->select('r')
            ->from(Representative::class, 'r')
            ->orderBy('r.alias')
            ->getQuery()
            ->getResult();
        foreach ($representatives as $representative) {
            $searchResults[] = $representative;
        }

        return $this->render('representatives.html.twig', [
            'current_page' => 'representatives',
            'representatives' => $searchResults
        ]);

    }
}
