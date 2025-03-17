<?php 

namespace App\Cards\Repository;

use App\Cards\Dtos\CardDto;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;


class FinanceAdsRepository {


    private const BASE_URL = 'https://tools.financeads.net/';

    public function __construct(private HttpClientInterface $httpClient, private LoggerInterface $logger)
    {
    }


    protected function request($method, $url, $options = []): ResponseInterface
    {
        $url = self::BASE_URL . $url;
        $response = $this->httpClient->request($method, $url, $options);

        return $response;
    }


    /**
     * Parse li items to array
     *
     * @param string $value
     * @return array
     */
    private function parseLiItemsToArray($value) {
        preg_match_all('/<li>(.*?)<\/li>/', $value, $matches);

        if (count($matches[1]) > 0) {
            return $matches[1];
        }

        return [];
    }


    public function getCards() : array
    {
        $response = $this->request('GET', 'webservice.php?wf=1&format=xml&calc=kreditkarterechner&country=ES');

        $content = $response->getContent();

        $content = htmlspecialchars_decode($content);
        $content = html_entity_decode($content);

        $xml = simplexml_load_string($content);
        
        $array = [];

        foreach ($xml->product as $product) {

            $besonderheiten = $this->parseLiItemsToArray($product->besonderheiten);
            $anmerkungen = $this->parseLiItemsToArray($product->anmerkungen);

            $product_string = $product->asXML();
            $content_crc = md5($product_string);
            $product->content_crc = $content_crc;

            unset($product->besonderheiten );
            unset($product->anmerkungen );

            foreach ($besonderheiten as $besonderheit) {
                $product->addChild('besonderheiten', $besonderheit);
            }

            foreach ($anmerkungen as $anmerkung) {
                $product->addChild('anmerkungen', $anmerkung);
            }

            $array[] = CardDto::fromXml($product);
        }

        $this->logger->info('Cards fetched', [
            'cards' => count($array),
            'time' => time()
        ]);

        return $array;
    }

}