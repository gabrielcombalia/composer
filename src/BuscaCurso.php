<?php


namespace Alura\BuscaCu;


use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class BuscaCurso
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpclient;
    /**
     * @var Crawler
     */
    private Crawler $crawler;

    public function __construct(ClientInterface $httpclient, Crawler $crawler)
    {
        $this->httpclient = $httpclient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpclient->request('GET', $url);

        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');

        $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
            
        }

        return $cursos;
        
    }

}