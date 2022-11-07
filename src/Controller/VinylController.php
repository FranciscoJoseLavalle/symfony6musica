<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage()
    {
        $tracks = [
            ['song' => 'November Rain', 'artist' => 'Guns N Roses'],
            ['song' => 'Todas las violas se van al cielo', 'artist' => 'Capitan Casino'],
            ['song' => 'Trátame Suavemente', 'artist' => 'Soda Stereo'],
            ['song' => 'Jijiji', 'artist' => 'Los redondos'],
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(HttpClientInterface $httpClient, CacheInterface $cache, $slug = null): Response
    {
        dump($cache);
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $cache->get('mixes-data', function(CacheItemInterface $cacheItem) use ($httpClient) {
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', "https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json");

            return $response->toArray();
        });

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
