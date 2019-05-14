<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
    */
    public function index()
    {
        // return new Response(
        //      '<html><body>Blog Index</body></html>'
        // );

        return $this->render('blog/index.html.twig', [
            'owner' => 'Thomas',
        ]);
    }


   /**
     * @Route("/blog/list/{page}",
     *     requirements={"page"="\d+"},
     *     defaults={"page"=1},
     *     name="blog_list"
     * )
     */

    public function list($page)
    {
        return $this->render('blog/list.html.twig', ['page' => $page]);
    }

    public function new()
    {
        // traitement d'un formulaire par exemple

        // redirection vers la page 'blog_list', correspondant à l'url /blog/list/5
        return $this->redirectToRoute('blog_list', ['page' => 5]);
    }

   /**
     * @Route("/blog/show/{slug}",
     *     requirements={"slug"="([a-z]|[0-9]|-)*"},
     *     name="blog_show"
     * )
     */

     public function show($slug = 'Article Sans Titre')
     { 
        $slug= ucwords (str_replace('-', ' ', $slug));
        return $this->render('blog/show.html.twig', ['slug' => $slug]);
     }

}