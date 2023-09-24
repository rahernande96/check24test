<?php
namespace App\Insurance;

use App\DTOs\InsuranceDTO;


/**
 * Interface for insurance strategies.
 */
interface InsuranceStrategy
{
    /**
     * Requests an insurance quote based on the provided insurance data transfer object.
     *
     * @param InsuranceDTO $insuranceDTO The insurance data transfer object.
     * @return string An array containing the insurance quote.
     */
    public function requestInsuranceQuote(InsuranceDTO $insuranceDTO): string; 
}
