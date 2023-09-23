<?php

namespace App\Insurance\FooInsurance;

use App\Model\InsuranceDTO;

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
        $generalData->addChild('CondPpalEsTomador', $this->insuranceDTO->holder === 'CONDUCTOR_PRINCIPAL' ? 'S' : 'N');
        $generalData->addChild('ConductorUnico', 'N');
        $generalData->addChild('FecCot', date('c'));
        $generalData->addChild('NroCondOca', '1');
        $generalData->addChild('AnosSegAnte', '5');
    }

    /**
     * Adds insurance company data to the XML request.
     *
     * @return void
     */
    private function addDatosAseguradora(): void
    {
        $prevInsuranceData = $this->xml->Datos->addChild('DatosAseguradora');
        $prevInsuranceData->addChild('SeguroEnVigor', 'N');
    }
}
