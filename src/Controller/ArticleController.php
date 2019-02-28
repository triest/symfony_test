<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 28.02.2019
 * Time: 20:44
 */

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleController extends Controller
{
    public function number()
    {
        //    $number = random_int(0, 100);

        /*  return new Response(
              '<html><body>Lucky number: '.$number.'</body></html>'
          );*/
    }

    /**
     * * @Route("/", name="articles", methods={"GET"})
     *
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig',array('articles'=>$articles));
    }

    /**
     * * @Route("/article/save", name="save", methods={"GET"})
     *
     */
    public function save()
    {
     $entityMenager=$this->getDoctrine()->getManager();
     $article=new Article();
     $article->setTitle("Test");
     $article->setBody("TestBody");
    $entityMenager->persist($article);
    $entityMenager->flush();
    }


    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', array('article' => $article));
    }

}