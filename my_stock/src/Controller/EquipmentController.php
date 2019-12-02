<?php

namespace App\Controller;

use App\Controller\Form\CreateType;
use App\Entity\Equipment;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EquipementType;

class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Method({"GET"})
     */
    public function index()
    {
        $equipement = $this->getDoctrine()->getRepository(Equipment::class)->findAll();
        return $this->render('equipment/index.html.twig', [
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
        $Equipment1 ->setDescription('Chasuuuule');
        $Equipment1 ->setPrice(round(122.156, 2));
        $Equipment1 ->setStock(12, 2);
        $Equipment2 = new Equipment();
        $Equipment2 ->setname('ballons');
        $Equipment2 ->setDescription('Ballloons');
        $Equipment2 ->setPrice(round(12.158, 2));
        $Equipment2 ->setStock(5);
        $Equipment3 = new Equipment();
        $Equipment3 ->setname('plots');
        $Equipment3 ->setDescription('Plooot');
        $Equipment3 ->setPrice(round(1.167, 2));
        $Equipment3 ->setStock(10);
        $Equipment4 = new Equipment();
        $Equipment4 ->setname('mini-plots');
        $Equipment4 ->setDescription('minnnnnni plop');
        $Equipment4 ->setPrice(round(22.776, 2));
        $Equipment4 ->setStock(8);
        $Equipment5 = new Equipment();
        $Equipment5 ->setname('barres');
        $Equipment5 ->setDescription('Barrrrrres');
        $Equipment5 ->setPrice(round(1222.1556, 2));
        $Equipment5 ->setStock(7);
        $Equipment6 = new Equipment();
        $Equipment6 ->setname('maillots');
        $Equipment6 ->setDescription('maillotsssss');
        $Equipment6 ->setPrice(round(22.176, 2));
        $Equipment6 ->setStock(15);
        $Equipment7 = new Equipment();
        $Equipment7 ->setname('shorts');
        $Equipment7 ->setDescription('Shhortss');
        $Equipment7 ->setPrice(round(127.156777, 2));
        $Equipment7 ->setStock(7);
        $Equipment8 = new Equipment();
        $Equipment8 ->setname('sifflets');
        $Equipment8 ->setDescription('Siffletsssss');
        $Equipment8 ->setPrice(round(1.756, 2));
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
        return $this->render('equipment/show.html.twig', [
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
        $form = $this->createForm(CreateType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('equipment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
