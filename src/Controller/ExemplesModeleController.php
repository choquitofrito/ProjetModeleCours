<?php

namespace App\Controller;

use App\Entity\Exemplaire;
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

        $tab = [
            'nom' => 'Fatima',
            'hobby' => 'chanter'
        ];


        // array à partir de l'objet
        $livreArray = (array) $livre;

        return $this->render(
            'exemples_modele/exemple_find_one_by.html.twig',
            [
                'livre' => $livre,
                'unTab' => $tab,
                'livreArray' => $livreArray
            ]
        );
    }

    /**
     * @Route("/exemples/modele/find/by")
     */
    public function exempleFindBy()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Livre::class);

        $livres = $rep->findBy(['prix' => 20]);

        return $this->render(
            'exemples_modele/exemple_find_by.html.twig',
            ['livres' => $livres]
        );
    }


    /**
     * @Route("/exemples/modele/insert/livre")
     */
    public function exempleInsertLivre()
    {
        $em = $this->getDoctrine()->getManager();
        $l1 = new Livre();
        $l1->setTitre("Tururu")
            ->setPrix(40);
        $em->persist($l1);
        $em->flush();
        return new Response("Le livre a été inséré!");
    }

    /**
     * @Route("/exemples/modele/delete/livre")
     */
    public function exempleDeleteLivre()
    {
        // obtenir de la BD un objet livre
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Livre::class);
        $l1 = $rep->find(1);

        // remove pour effacer de la BD
        $em->remove($l1);
        $em->flush();

        return new Response("Le livre a été efface!");
    }

    /**
     * @Route("/exemples/modele/rajouter/livre/exemplaires")
     */
    public function rajouterLivreExemplaires()
    {
        $em = $this->getDoctrine()->getManager();

        $l1 = new Livre();
        $l1->setTitre("Livre 1")
            ->setPrix(40);

        $e1 = new Exemplaire();
        $e1->setEtat("vieux");
   
        // un autre livre avec hydrate
        $eh = new Livre (['titre'=>'Coucou',
                        'isbn'=>'1234123412341234']);
        // dd($eh);

        //$e1->setLivre($l1); // crée le lien à partir de l'exemplaire vers le livre
        $l1->addExemplaire($e1); // rajoute l'exemplaire à la collection d'exemplaires
                                // dans livre et 
                                // crée le lien à partir de l'exemplaire vers le livre

        $e2 = new Exemplaire();
        $e2->setEtat("nouveau");
        $l1->addExemplaire($e2);    

        //$em->persist($e1);
        //$em->persist($e2);
        
        $em->persist($l1);

        $em->flush();
        return new Response("Ok");
    }
}
