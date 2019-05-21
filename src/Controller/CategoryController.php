<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category", name="add_category")
    */
    
    public function add(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);
     
        if ($form->isSubmitted()) {
           $data = $form->getData();
           // $data contient les données du $_POST
           // Faire une recherche dans la BDD avec les infos de $data...
         
           $category = $this->getDoctrine()->getManager();
           $category->persist($data);
           $category->flush();

           return $this->render(
            'blog/formGG.html.twig'
         );
        } else {
                return $this->render(
                'blog/formAdd.html.twig', [
                'form' => $form->createView()
                ]
            );
        }
    }
}