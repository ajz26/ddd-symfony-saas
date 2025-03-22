<?php 

namespace App\Cards\Infrastructure\External\FinanceAds;

use App\Cards\Domain\Provider\CardProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Cards\Infrastructure\External\FinanceAds\FinanceAdsCardAdapter;
class FinanceAdsProvider implements CardProviderInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly string $apiUrl,
        private readonly FinanceAdsCardAdapter $adapter
    ) {}

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
        $response = $this->client->request('GET', $this->apiUrl . 'webservice.php?wf=1&format=xml&calc=kreditkarterechner&country=ES');

        $content = $response->getContent();
        $content = htmlspecialchars_decode($content);
        $content = html_entity_decode($content);

        $xml = simplexml_load_string($content);
        
        $array = [];

        foreach ($xml->product as $product) {
            // Convertir el producto XML a array usando json
            $productArray = json_decode(json_encode($product), true);
            
            // Procesar los elementos li
            $productArray['services'] = $this->parseLiItemsToArray($product->besonderheiten);
            $productArray['benefits'] = $this->parseLiItemsToArray($product->anmerkungen);
            
            $productArray['description'] = "";

            // Agregar content_crc
            $productArray['content_crc'] = md5($product->asXML());

            // Convertir a objeto de dominio
            $card = $this->adapter->toDomain($productArray);

            
            $array[] = $card;
        }


        return $array;
    }
} 