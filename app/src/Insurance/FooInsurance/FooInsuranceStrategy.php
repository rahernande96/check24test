<?php
namespace App\Insurance\FooInsurance;

use App\Insurance\InsuranceStrategy;
use App\Model\InsuranceDTO;

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
     * @return array<string> The response.
     */
    public function requestInsuranceQuote(InsuranceDTO $insuranceDTO): array
    {
        $buildRequest = (new BuildRequest($insuranceDTO))->build();
        
        dump( $buildRequest->asXML() );

        // TODO: call the insurance API and return the response.

        // TODO: return the response.
        
        return (array) $insuranceDTO;
    }
    
}