<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TranslationService;
use App\Repository\NewsRepository;

class CoursController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/', name: 'app_cours')]
    public function index(): Response
    {
 return $this->render('page/cours/index.html.twig', [
            'test' => 'test',
        ]);
    }
}
?>
