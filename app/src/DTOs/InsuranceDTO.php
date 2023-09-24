<?php
namespace App\DTOs;

use Symfony\Component\Validator\Constraints as Assert;

#[Assert\GroupSequence(['InsuranceDTO', 'hasBothDates', 'isContractDateLessThanOrEqualThanExpirationDate'])]
class InsuranceDTO
{
    public function __construct(
    

        #[Assert\Type('string')]
        #[Assert\NotBlank(
            message: 'The vehicle holder is required.',
        )]
        public string $holder,

        #[Assert\Type('string')]
        #[Assert\NotBlank(
            message: 'The occasionalDriver is required.',
        )]
        public string $occasionalDriver,

        #[Assert\Type('string')]
        #[Assert\NotBlank(
            message: 'The prevInsurance_exists is required.',
        )]
        public string $prevInsurance_exists,
        
        #[Assert\Date]
        public ?string $prevInsurance_contractDate,

        #[Assert\Date]
        public ?string $prevInsurance_expirationDate,
        
       
    ) {}

    #[Assert\IsTrue(
        message: 'The previous insurance contract date and expiration date are both required.',
        groups: ['hasBothDates'],
    )]
    public function hasBothDates(): bool
    {
        return ($this->prevInsurance_contractDate !== null) === ($this->prevInsurance_expirationDate !== null);
    }

    #[Assert\IsTrue(
        message: 'The previous insurance contract date must be less than or equal to the expiration date.',
        groups: ['isContractDateLessThanOrEqualThanExpirationDate'],
    )]
    public function isContractDateLessThanOrEqualThanExpirationDate(): bool
    {

        return date_create($this->prevInsurance_contractDate) <= date_create($this->prevInsurance_expirationDate);
    }


}