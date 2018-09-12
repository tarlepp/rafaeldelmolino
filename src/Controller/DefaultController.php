<?php

namespace App\Controller;

use App\Entity\Bar;
use App\Entity\Foo;
use App\Repository\BarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @Route("/")
 *
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("", name="default", methods={"GET"})
     *
     * @param BarRepository $barRepository
     *
     * @return Response
     */
    public function index(BarRepository $barRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'items' => $barRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     *
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function createDummyData()
    {
        $em = $this->getDoctrine()->getManager();
        $faker = \Faker\Factory::create();

        $bar = (new Bar())->setName($faker->name);

        $items = random_int(1, 3);

        for ($i = 0; $i < $items; $i++) {
            $foo = (new Foo())->setName($faker->name)->setBar($bar);

            $bar->addFoo($foo);
            $em->persist($foo);
        }

        $em->persist($bar);
        $em->flush();

        return new RedirectResponse($this->generateUrl('default'));
    }

    /**
     * @Route("/clone/{barId}", name="create", methods={"GET"})
     *
     * @param BarRepository $barRepository
     * @param               $barId
     *
     * @return RedirectResponse
     */
    public function cloneData(BarRepository $barRepository, $barId): RedirectResponse
    {
        $entity = $barRepository->find($barId);

        if ($entity !== null) {
            $em = $this->getDoctrine()->getManager();

            $newEntity = clone $entity;

            $em->persist($newEntity);

            $newEntity->getFoos()->map(function (Foo $foo) use ($em) { $em->persist($foo); });

            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('default'));
    }
}
