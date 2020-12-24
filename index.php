<?php

require 'vendor/autoload.php';
require 'src/BuscaCurso.php';

use Alura\BuscaCu\BuscaCurso;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' =>'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscaCuzao = new BuscaCurso($client, $crawler);
$cursos = $buscaCuzao->buscar('cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo $curso.PHP_EOL;
}