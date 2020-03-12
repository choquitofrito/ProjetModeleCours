<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesModeleController extends AbstractController
{
    /**
     * @Route("/exemples/modele/find/one/by")
     */
    public function exempleFindOneBy()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Livre::class);
        $livre = $rep->findOneBy([
            'titre' => 'Life and Fate',
            'prix' => '20'
        ]);

        $tab = ['nom'=>'Fatima',
                'hobby'=> 'chanter'];

        
        // array à partir de l'objet
        $livreArray = (array)$livre;
                
        return $this->render(
            'exemples_modele/exemple_find_one_by.html.twig',
            ['livre'=> $livre,
            'unTab'=> $tab,
            'livreArray'=> $livreArray]
        );
    }

    /**
     * @Route("/exemples/modele/find/by")
     */
    public function exempleFindBy (){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Livre::class);
        
        $livres = $rep->findBy(['prix'=> 20]);
        
        return $this->render (
            'exemples_modele/exemple_find_by.html.twig',
            ['livres'=> $livres]
        );

    }


    /**
     * @Route("/exemples/modele/insert/livre")
     */
    public function exempleInsertLivre (){
        $em = $this->getDoctrine()->getManager();
        $l1 = new Livre();
        $l1->setTitre("Tururu")
           ->setPrix(40);
        $em->persist($l1);
        $em->flush();
        return new Response ("Le livre a été inséré!");
    }



}
