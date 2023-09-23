<?php
namespace App\Insurance;

use App\Model\InsuranceDTO;


/**
 * Interface for insurance strategies.
 */
interface InsuranceStrategy
{
    /**
     * Requests an insurance quote based on the provided insurance data transfer object.
     *
     * @param InsuranceDTO $insuranceDTO The insurance data transfer object.
     * @return array<string> An array containing the insurance quote.
     */
    public function requestInsuranceQuote(InsuranceDTO $insuranceDTO): array; 
}
