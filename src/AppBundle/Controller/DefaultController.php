<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MangaList;
use AppBundle\Entity\MangaListCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\ApiService;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("default/index.html.twig")
     *
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return array('base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR);
    }


    /**
     * @Route("/recherche", name="searchList")
     * @Template("default/search.html.twig")
     */
    public function searchListAction(Request $request, ApiService $api)
    {
        $dataSearch = $request->request->get('searchinput');
        $list = $api->getListMangasTitle($dataSearch);
        // replace this example code with whatever you need
        return array('list' => $list);
    }

    /**
     * @Route("/recherche-list/{id}", name="searchMangaList")
     * @Template("default/mangaList.html.twig")
     */
    public function searchMangaAction(Request $request, ApiService $api)
    {
        $dataSearch = $request->get('id');
        $list = $api->getMangasFromTitle($dataSearch);
        dump($list);
        // replace this example code with whatever you need
        return array('list' => $list);
    }

    /**
     * @Route("/ma-liste", name="myMangaList")
     * @Template("default/myMangaList.html.twig")
     */
    public function myMangaAction()
    {
        $em          = $this->getDoctrine()->getManager();
        $mangaRep        = $em->getRepository("AppBundle:MangaList");
        $collectionRep = $em->getRepository("AppBundle:MangaListCollection");

        $myCollections = $collectionRep->findAll();
        $myMangas = $mangaRep->findAll();
        dump($myCollections);
        // replace this example code with whatever you need
        return array('collections' => $myCollections, 'mangas' => $myMangas);
    }

    /**
     * ajax ajout manga dans sa liste
     * @Route("/addManga", name="ajax-add", condition="request.isXmlHttpRequest()")
     */
    function addMangaAction (Request $request){
        $em          = $this->getDoctrine()->getManager();
        $mangaRep        = $em->getRepository("AppBundle:MangaList");
        $collectionRep = $em->getRepository("AppBundle:MangaListCollection");

        $collectionTitle  = $request->get("collectionTitle");
        $collectionMuid  = $request->get("collectionMuid");
        $collectionAuthors  = $request->get("collectionAuthors");
        $collectionCount  = $request->get("collectionCount");
        $collectionYear  = $request->get("collectionYear");
        $mangaImg  = $request->get("mangaImg");
        $mangaVolume  = $request->get("mangaVolume");

        $collection = $collectionRep->findOneBy(array('muid' => $collectionMuid));
        if(!$collection){
            $collection = new MangaListCollection();
            $collection->setAuthors($collectionAuthors);
            $collection->setTitle($collectionTitle);
            $collection->setMuid($collectionMuid);
            $collection->setYear($collectionYear);
            $collection->setCount($collectionCount);
            $em->persist($collection);
        }

        $manga = $mangaRep->findOneBy(array('pictureFront' => $mangaImg));
        if (!$manga) {
            $manga = new MangaList();
            $manga->setPictureFront($mangaImg);
            $manga->setVolumeNumber($mangaVolume);
            $manga->setCollection($collection);
            $em->persist($manga);
            $em->flush();
        } else {
            return new Response('NOK');
        }
        return new Response('OK');
    }

    /**
     * ajax delete manga dans sa liste
     * @Route("/deleteManga", name="delete-manga", condition="request.isXmlHttpRequest()")
     */
    function deleteMangaAction (Request $request){
        $em          = $this->getDoctrine()->getManager();
        $mangaRep        = $em->getRepository("AppBundle:MangaList");
        $id    = $request->get('mangaId');

        $manga   = $mangaRep->find($id);

        if (!$manga) {
            throw $this->createNotFoundException('Unable to find entity.');
        }else {
            $collection = $manga->getCollection();
            $mangaList   = $mangaRep->findBy(array('collection' => $collection));
            $em->remove($manga);
            if(count($mangaList) <= 1){
                $em->remove($collection);
                $resp = 'OKCollec';
            } else {
                $resp = 'OK';
            }
            $em->flush();
            return new Response($resp);
        }
    }
}
