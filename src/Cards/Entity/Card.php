<?php
namespace App\Cards\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Cards\Repository\CardRepository;
use App\Cards\Interfaces\Card as CardInterface;


#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ORM\Table(name: 'cards')]
class Card implements CardInterface
{
    

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $link;

    #[ORM\Column(length: 255)]
    private string $logo;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $test_seal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $test_seal_url = null;

    #[ORM\Column]
    private int $bank_id;

    #[ORM\Column]
    private int $product_id;

    #[ORM\Column(type: 'json')]
    private array $description;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $custom_description = null;

    #[ORM\Column(length: 255)]
    private string $bank;

    #[ORM\Column(length: 255)]
    private string $product;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custom_product_name = null;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 1, nullable: true)]
    private ?float $rating = null;

    #[ORM\Column(type: 'boolean')]
    private bool $evaluation_number = false;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?float $incentive = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $fees = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $cost = null;

    #[ORM\Column(type: 'boolean')]
    private bool $bonusprogram = false;

    #[ORM\Column(type: 'boolean')]
    private bool $insurance = false;

    #[ORM\Column(type: 'boolean')]
    private bool $benefits = false;

    #[ORM\Column(type: 'boolean')]
    private bool $services = false;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $special_features = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fees_action = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cost_action = null;

    #[ORM\Column(type: 'float')]
    private float $fees_first_year;

    #[ORM\Column(type: 'float')]
    private float $fees_after_first_year;

    #[ORM\Column(type: 'float')]
    private float $gc_atmfree_domestic;

    #[ORM\Column(type: 'float')]
    private float $gc_atmfree_international;

    #[ORM\Column(type: 'float')]
    private float $cc_atmfree_domestic;

    #[ORM\Column(type: 'float')]
    private float $cc_atmfree_international;

    #[ORM\Column(type: 'float')]
    private float $incentive_amount;

    #[ORM\Column(type: 'float')]
    private float $interest_rate;

    #[ORM\Column(type: 'float')]
    private float $shall_interest_rate;

    #[ORM\Column(type: 'smallint')]
    private int $cardtype = 0;

    #[ORM\Column(length: 10)]
    private string $cardtype_text;

    #[ORM\Column(type: 'float')]
    private float $cc_atmfree_euro;

    #[ORM\Column(type: 'boolean')]
    private bool $kkoffer = false;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $updated_at;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custom_cost_action = null;

    #[ORM\Column(length: 255)]
    private string $content_crc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = $link;
        return $this;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo)
    {
        $this->logo = $logo;
        return $this;
    }

    public function getTestSeal(): ?string
    {
        return $this->test_seal;
    }

    public function setTestSeal(?string $test_seal)
    {
        $this->test_seal = $test_seal;
        return $this;
    }

    public function getTestSealUrl(): ?string
    {
        return $this->test_seal_url;
    }

    public function setTestSealUrl(?string $test_seal_url)
    {
        $this->test_seal_url = $test_seal_url;
        return $this;
    }

    public function getBankId(): int
    {
        return $this->bank_id;
    }

    public function setBankId(int $bank_id)
    {
        $this->bank_id = $bank_id;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    public function setDescription(array $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCustomDescription(): ?string
    {
        return $this->custom_description;
    }

    public function setCustomDescription(?string $custom_description)
    {
        $this->custom_description = $custom_description;
        return $this;
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function setBank(string $bank)
    {
        $this->bank = $bank;
        return $this;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function setProduct(string $product)
    {
        $this->product = $product;
        return $this;
    }

    public function getCustomProductName(): ?string
    {
        return $this->custom_product_name;
    }

    public function setCustomProductName(?string $custom_product_name)
    {
        $this->custom_product_name = $custom_product_name;
        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating)
    {
        $this->rating = $rating;
        return $this;
    }

    public function getEvaluationNumber(): bool
    {
        return $this->evaluation_number;
    }

    public function setEvaluationNumber(bool $evaluation_number)
    {
        $this->evaluation_number = $evaluation_number;
        return $this;
    }

    public function getIncentive(): ?float
    {
        return $this->incentive;
    }

    public function setIncentive(?float $incentive)
    {
        $this->incentive = $incentive;
        return $this;
    }

    public function getFees(): ?float
    {
        return $this->fees;
    }

    public function setFees(?float $fees)
    {
        $this->fees = $fees;
        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost)
    {
        $this->cost = $cost;
        return $this;
    }

    public function getBonusprogram(): bool
    {
        return $this->bonusprogram;
    }

    public function setBonusprogram(bool $bonusprogram)
    {
        $this->bonusprogram = $bonusprogram;
        return $this;
    }

    public function getInsurance(): bool
    {
        return $this->insurance;
    }

    public function setInsurance(bool $insurance)
    {
        $this->insurance = $insurance;
        return $this;
    }

    public function getBenefits(): bool
    {
        return $this->benefits;
    }

    public function setBenefits(bool $benefits)
    {
        $this->benefits = $benefits;
        return $this;
    }

    public function getServices(): bool
    {
        return $this->services;
    }

    public function setServices(bool $services)
    {
        $this->services = $services;
        return $this;
    }

    public function getSpecialFeatures(): ?array
    {
        return $this->special_features;
    }

    public function setSpecialFeatures(?array $special_features)
    {
        $this->special_features = $special_features;
        return $this;
    }

    public function getFeesAction(): ?string
    {
        return $this->fees_action;
    }

    public function setFeesAction(?string $fees_action)
    {
        $this->fees_action = $fees_action;
        return $this;
    }

    public function getCostAction(): ?string
    {
        return $this->cost_action;
    }

    public function setCostAction(?string $cost_action)
    {
        $this->cost_action = $cost_action;
        return $this;
    }

    public function getFeesFirstYear(): float
    {
        return $this->fees_first_year;
    }

    public function setFeesFirstYear(float $fees_first_year)
    {
        $this->fees_first_year = $fees_first_year;
        return $this;
    }

    public function getFeesAfterFirstYear(): float
    {
        return $this->fees_after_first_year;
    }

    public function setFeesAfterFirstYear(float $fees_after_first_year)
    {
        $this->fees_after_first_year = $fees_after_first_year;
        return $this;
    }

    public function getGcAtmfreeDomestic(): float
    {
        return $this->gc_atmfree_domestic;
    }

    public function setGcAtmfreeDomestic(float $gc_atmfree_domestic)
    {
        $this->gc_atmfree_domestic = $gc_atmfree_domestic;
        return $this;
    }

    public function getGcAtmfreeInternational(): float
    {
        return $this->gc_atmfree_international;
    }

    public function setGcAtmfreeInternational(float $gc_atmfree_international)
    {
        $this->gc_atmfree_international = $gc_atmfree_international;
        return $this;
    }

    public function getCcAtmfreeDomestic(): float
    {
        return $this->cc_atmfree_domestic;
    }

    public function setCcAtmfreeDomestic(float $cc_atmfree_domestic)
    {
        $this->cc_atmfree_domestic = $cc_atmfree_domestic;
        return $this;
    }

    public function getCcAtmfreeInternational(): float
    {
        return $this->cc_atmfree_international;
    }

    public function setCcAtmfreeInternational(float $cc_atmfree_international)
    {
        $this->cc_atmfree_international = $cc_atmfree_international;
        return $this;
    }

    public function getIncentiveAmount(): float
    {
        return $this->incentive_amount;
    }

    public function setIncentiveAmount(float $incentive_amount)
    {
        $this->incentive_amount = $incentive_amount;
        return $this;
    }

    public function getInterestRate(): float
    {
        return $this->interest_rate;
    }

    public function setInterestRate(float $interest_rate)
    {
        $this->interest_rate = $interest_rate;
        return $this;
    }

    public function getShallInterestRate(): float
    {
        return $this->shall_interest_rate;
    }

    public function setShallInterestRate(float $shall_interest_rate)
    {
        $this->shall_interest_rate = $shall_interest_rate;
        return $this;
    }

    public function getCardtype(): int
    {
        return $this->cardtype;
    }

    public function setCardtype(int $cardtype)
    {
        $this->cardtype = $cardtype;
        return $this;
    }

    public function getCardtypeText(): string
    {
        return $this->cardtype_text;
    }

    public function setCardtypeText(string $cardtype_text)
    {
        $this->cardtype_text = $cardtype_text;
        return $this;
    }

    public function getCcAtmfreeEuro(): float
    {
        return $this->cc_atmfree_euro;
    }

    public function setCcAtmfreeEuro(float $cc_atmfree_euro)
    {
        $this->cc_atmfree_euro = $cc_atmfree_euro;
        return $this;
    }

    public function getKkoffer(): bool
    {
        return $this->kkoffer;
    }

    public function setKkoffer(bool $kkoffer)
    {
        $this->kkoffer = $kkoffer;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getCustomCostAction(): ?string
    {
        return $this->custom_cost_action;
    }

    public function setCustomCostAction(?string $custom_cost_action)
    {
        $this->custom_cost_action = $custom_cost_action;
        return $this;
    }

    public function getContentCrc(): string
    {
        return $this->content_crc;
    }

    public function setContentCrc(string $content_crc)
    {
        $this->content_crc = $content_crc;
        return $this;
    }
    
}