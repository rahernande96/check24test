<?php
namespace App\Service;

use App\Insurance\InsuranceStrategy;
use App\Model\InsuranceDTO;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class InsuranceService
{
    private InsuranceStrategy $strategy;

    public function __construct(
        #[Autowire(service: 'App\Insurance\FooInsurance\FooInsuranceStrategy')]
        InsuranceStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Requests an insurance quote using the provided InsuranceDTO object.
     *
     * @param InsuranceDTO $insuranceDTO The InsuranceDTO object containing the necessary information for the quote.
     * @return array<string> An array containing the quote information.
     */
    public function requestInsuranceQuote(InsuranceDTO $insuranceDTO): array
    {
        return $this->strategy->requestInsuranceQuote($insuranceDTO);
    }
}
