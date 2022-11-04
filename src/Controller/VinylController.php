<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage()
    {
        $tracks = [
            ['song' => 'November Rain','artist' => 'Guns N Roses'],
            ['song' => 'Todas las violas se van al cielo', 'artist' => 'Capitan Casino'],
            ['song' => 'Trátame Suavemente','artist' => 'Soda Stereo'],
            ['song' => 'Jijiji','artist' => 'Los redondos'],
        ];

        return $this->render('vinyl/homepage.html.twig',[
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse($slug = null)
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        return $this->render('vinyl/browse.html.twig',[
            'genre' => $genre,
        ]);
    }
}