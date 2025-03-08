<?php
namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseBlockRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/', name: 'app_cours')]
    public function index(CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findAll();

        return $this->render('page/cours/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    #[Route('/cours/{id}/{page}', name: 'app_cours_view', requirements: ['id' => '\d+', 'page' => '\d+'])]
    public function view(Course $course, int $page = 1, CourseBlockRepository $courseBlockRepository): Response
    {
        $maxPageNumber = $courseBlockRepository->getMaxPageNumber($course);
        $blocks = $courseBlockRepository->getBlocksByPage($course, $page);

        return $this->render('page/cours/view.html.twig', [
            'course' => $course,
            'blocks' => $blocks,
            'currentPage' => $page,
            'maxPageNumber' => $maxPageNumber,
        ]);
    }
}
