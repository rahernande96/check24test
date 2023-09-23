<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class InsuranceDTO
{
    public function __construct(
        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_brand,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_fuel,
        
        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_model,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_power,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_purchaseSituation,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $car_version,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $customer_journey_ok,

        #[Assert\Date]
        #[Assert\NotBlank()]
        public string $driver_birthDate,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_birthPlace,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_birthPlaceMain,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_children,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_civilStatus,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_id,

        #[Assert\Date]
        #[Assert\NotBlank()]
        public string $driver_licenseDate,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_licensePlace,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_licensePlaceMain,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_profession,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $driver_sex,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $holder,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $occasionalDriver,

        #[Assert\Type('integer')]
        #[Assert\NotBlank()]
        public int $prevInsurance_claimsCount,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $prevInsurance_emailRequest,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $prevInsurance_exists,

        #[Assert\Type('integer')]
        #[Assert\NotBlank()]
        public int $prevInsurance_modality,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $reference_code,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $use_carUse,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        public string $use_nightParking,

        #[Assert\Type('integer')]
        #[Assert\NotBlank()]
        public int $use_postalCode,
    ) {}
}