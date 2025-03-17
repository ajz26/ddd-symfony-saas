<?php 

namespace App\Cards\Interfaces;

/**
 * Card interface
 * @package App\Cards\Interfaces
 */
interface Card
{

    public function getId(): ?int;
    public function getLink(): string;
    public function setLink(string $link);
    public function getLogo(): string;
    public function setLogo(string $logo);
    public function getTestSeal(): ?string;
    public function setTestSeal(?string $test_seal);
    public function getTestSealUrl(): ?string;
    public function setTestSealUrl(?string $test_seal_url);
    public function getBankId(): int;
    public function setBankId(int $bank_id);
    public function getProductId(): int;
    public function setProductId(int $product_id);
    public function getDescription(): array;
    public function setDescription(array $description);
    public function getCustomDescription(): ?string;
    public function setCustomDescription(?string $custom_description);
    public function getBank(): string;
    public function setBank(string $bank);
    public function getProduct(): string;
    public function setProduct(string $product);
    public function getCustomProductName(): ?string;
    public function setCustomProductName(?string $custom_product_name);
    public function getRating(): ?float;
    public function setRating(?float $rating);
    public function getEvaluationNumber(): bool;
    public function setEvaluationNumber(bool $evaluation_number);
    public function getIncentive(): ?float;
    public function setIncentive(?float $incentive);
    public function getFees(): ?float;
    public function setFees(?float $fees);
    public function getCost(): ?float;
    public function setCost(?float $cost);
    public function getBonusprogram(): bool;
    public function setBonusprogram(bool $bonusprogram);
    public function getInsurance(): bool;
    public function setInsurance(bool $insurance);
    public function getBenefits(): bool;
    public function setBenefits(bool $benefits);
    public function getServices(): bool;
    public function setServices(bool $services);
    public function getSpecialFeatures(): ?array;
    public function setSpecialFeatures(?array $special_features);
    public function getFeesAction(): ?string;
    public function setFeesAction(?string $fees_action);
    public function getCostAction(): ?string;
    public function setCostAction(?string $cost_action);
    public function getFeesFirstYear(): float;
    public function setFeesFirstYear(float $fees_first_year);
    public function getFeesAfterFirstYear(): float;
    public function setFeesAfterFirstYear(float $fees_after_first_year);
    public function getGcAtmfreeDomestic(): float;
    public function setGcAtmfreeDomestic(float $gc_atmfree_domestic);
    public function getGcAtmfreeInternational(): float;
    public function setGcAtmfreeInternational(float $gc_atmfree_international);
    public function getCcAtmfreeDomestic(): float;
    public function setCcAtmfreeDomestic(float $cc_atmfree_domestic);
    public function getCcAtmfreeInternational(): float;
    public function setCcAtmfreeInternational(float $cc_atmfree_international);
    public function getIncentiveAmount(): float;
    public function setIncentiveAmount(float $incentive_amount);
    public function getInterestRate(): float;
    public function setInterestRate(float $interest_rate);
    public function getShallInterestRate(): float;
    public function setShallInterestRate(float $shall_interest_rate);
    public function getCardtype(): int;
    public function setCardtype(int $cardtype);
    public function getCardtypeText(): string;
    public function setCardtypeText(string $cardtype_text);
    public function getCcAtmfreeEuro(): float;
    public function setCcAtmfreeEuro(float $cc_atmfree_euro);
    public function getKkoffer(): bool;
    public function setKkoffer(bool $kkoffer);
    public function getCreatedAt(): ?\DateTime;
    public function setCreatedAt(\DateTime $created_at);
    public function getUpdatedAt(): ?\DateTime;
    public function setUpdatedAt(\DateTime $updated_at);
    public function getCustomCostAction(): ?string;
    public function setCustomCostAction(?string $custom_cost_action);
    public function getContentCrc(): string;
    public function setContentCrc(string $content_crc);
    
}