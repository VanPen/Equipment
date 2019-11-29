<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @Method({"GET"})
     */
    public function index()
    {
        $equipement = $this->getDoctrine()->getRepository(Equipment::class)->findAll();

        return $this->render('equipement/index.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    /**
     * @Route("/load", name="load")
     * @Method({"POST"})
     */
    public function loadAction(){
        $Equipment1 = new Equipment();
        $Equipment1 ->setname('chasubles');
        $Equipment1 ->setStock(12);
        $Equipment2 = new Equipment();
        $Equipment2 ->setname('ballons');
        $Equipment2 ->setStock(5);
        $Equipment3 = new Equipment();
        $Equipment3 ->setname('plots');
        $Equipment3 ->setStock(10);
        $Equipment4 = new Equipment();
        $Equipment4 ->setname('mini-plots');
        $Equipment4 ->setStock(8);
        $Equipment5 = new Equipment();
        $Equipment5 ->setname('barres');
        $Equipment5 ->setStock(7);
        $Equipment6 = new Equipment();
        $Equipment6 ->setname('maillots');
        $Equipment6 ->setStock(15);
        $Equipment7 = new Equipment();
        $Equipment7 ->setname('shorts');
        $Equipment7 ->setStock(7);
        $Equipment8 = new Equipment();
        $Equipment8 ->setname('sifflets');
        $Equipment8 ->setStock(2);
        $array = [$Equipment1, $Equipment2, $Equipment3, $Equipment4, $Equipment5, $Equipment6, $Equipment7, $Equipment8];
        $em = $this->getDoctrine()->getManager();
        foreach($array as $equipement)
        {
            $em->persist($equipement);
        }
        $em->flush();

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/infos/{id}", name="info" )
     * @Method({"GET"})
     */
    public function info($id){
        $equipement = $this->getDoctrine()->getRepository(Equipment::class)->find($id);

        return $this->render('equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    /**
     * @Route("/add", name="add_equipement")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        $task = new Equipment();

        $form = $this->createForm(EquipementType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
            return $this->render('equipement/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }
}
