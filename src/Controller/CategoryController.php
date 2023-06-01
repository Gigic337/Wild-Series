<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Form\CategoryType;
use App\Entity\Category;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository) : Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $categoryRepository->save($category, true);

            // Redirect to category list
            return $this->redirectToRoute('category_index');
        }

        // Render the form
        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
   public function show(string $categoryName,
                        CategoryRepository $categoryRepository,
                        ProgramRepository $programRepository
    ): Response
    {

    $category = $categoryRepository->findOneBy(['name' => $categoryName]);

    $programs = $programRepository->findByCategory($category, ['id' => 'DESC'], 3);

    if (!$category) {
        throw $this->CreateNotFoundException(
            'No category in  : ' .$categoryName
       );
    }
    return $this->render('category/show.html.twig', [
        'category' =>$category,
        'programs' =>$programs
    ]);


    }



}