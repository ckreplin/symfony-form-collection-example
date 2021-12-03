<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /** @var ProductRepository */
    private $repo;

    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param ProductRepository $repo
     * @param EntityManagerInterface $em
     */
    public function __construct(ProductRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**
     * @Route("/"))
     *
     */
    public function indexAction(Request $request): Response
    {
        $items = $this->repo->findBy([]);
        $product = count($items) > 0 ? $items[0] : new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($product->getTags() as $tag) {
                $this->em->persist($tag);
            }

            $this->em->persist($product);
            $this->em->flush();
        }

        return $this->render('index.html.twig', ['form' => $form->createView()]);
    }
}