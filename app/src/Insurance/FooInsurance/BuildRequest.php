<?php

namespace App\Insurance\FooInsurance;

use App\DTOs\InsuranceDTO;

class BuildRequest
{
    private InsuranceDTO $insuranceDTO;
    private \SimpleXMLElement $xml;

    public function __construct(InsuranceDTO $insuranceDTO)
    {
        $this->insuranceDTO = $insuranceDTO;
        $this->xml = new \SimpleXMLElement('<TarificacionThirdPartyRequest></TarificacionThirdPartyRequest>');
    }

    /**
     * Builds and returns a SimpleXMLElement object containing the insurance request data.
     *
     * @return \SimpleXMLElement The SimpleXMLElement object containing the insurance request data.
     */
    public function build(): \SimpleXMLElement
    {
        $this->addDatos();
        $this->addDatosGenerales();
        $this->addDatosAseguradora();
        
        return $this->xml;
    }

    /**
     * Adds a new 'Datos' child element to the XML document.
     *
     * @return void
     */
    private function addDatos(): void
    {
        $this->xml->addChild('Datos');
    }

    /**
     * Adds general data to the XML request.
     *
     * @return void
     */
    private function addDatosGenerales(): void
    {
        $generalData = $this->xml->Datos->addChild('DatosGenerales');
        $generalData->addChild('CondPpalEsTomador', $this->insuranceDTO->holder === 'CONDUCTOR_PRINCIPAL' ? 'N' : 'S');
        $generalData->addChild('ConductorUnico', $this->insuranceDTO->occasionalDriver === 'SI' ? 'N' : 'S');
        $generalData->addChild('FecCot', date('c'));
        $generalData->addChild('NroCondOca', $this->insuranceDTO->occasionalDriver === 'SI' ? '1' : '0');
        $generalData->addChild('AnosSegAnte', $this->getPrevInsuranceYears());
    }

    
    /**
     * Calculates the number of years between the previous insurance contract date and expiration date.
     *
     * @return string The number of years between the previous insurance contract date and expiration date.
     */
    private function getPrevInsuranceYears(): string
    {
        $contractYear = date_create($this->insuranceDTO->prevInsurance_contractDate)->format('Y');
        $expirationYear = date_create($this->insuranceDTO->prevInsurance_expirationDate)->format('Y');
        
        return strval($expirationYear - $contractYear);
    }

    /**
     * Adds insurance company data to the XML request.
     *
     * @return void
     */
    private function addDatosAseguradora(): void
    {
        $prevInsuranceData = $this->xml->Datos->addChild('DatosAseguradora');
        $prevInsuranceData->addChild('SeguroEnVigor', $this->insuranceDTO->prevInsurance_exists === 'SI' ? 'S' : 'N');
    }
}
