<?php
namespace App\Insurance\FooInsurance;

use App\Insurance\InsuranceStrategy;
use App\DTOs\InsuranceDTO;

/**
 * This class is the implementation of the InsuranceStrategy interface.
 */
class FooInsuranceStrategy implements InsuranceStrategy
{

    /**
     * This method is the implementation of the requestInsuranceQuote method from the InsuranceStrategy interface.
     * 
     * @param InsuranceDTO $insuranceDTO The insurance DTO.
     * 
     * @return string The response.
     */
    public function requestInsuranceQuote(InsuranceDTO $insuranceDTO): string
    {
        $buildRequest = (new BuildRequest($insuranceDTO))->build();
        

        // TODO: call the insurance API and return the response.

        // TODO: return the response.++

        
        return (string) $buildRequest->asXML();
    }
    
}