<?php

namespace App\Tests\Insurance\FooInsurance;

use App\DTOs\InsuranceDTO;
use App\Insurance\FooInsurance\BuildRequest;
use PHPUnit\Framework\TestCase;

class BuildRequestTest extends TestCase
{
    public function testBuild(): void
    {
        $insuranceDTO = new InsuranceDTO(
            holder: 'CONDUCTOR_PRINCIPAL',
            occasionalDriver: 'SI',
            prevInsurance_contractDate: '2013-03-03',
            prevInsurance_expirationDate: '2021-03-02',
            prevInsurance_exists: 'SI'
        );

        $buildRequest = new BuildRequest($insuranceDTO);
        $xml = $buildRequest->build();

        $expectedXml = '<?xml version="1.0"?>
        <TarificacionThirdPartyRequest>
        <Datos>
            <DatosGenerales>
            <CondPpalEsTomador>N</CondPpalEsTomador>
            <ConductorUnico>N</ConductorUnico>
            <FecCot>' . date('c') . '</FecCot>
            <NroCondOca>1</NroCondOca>
            <AnosSegAnte>8</AnosSegAnte>
            </DatosGenerales>
            <DatosAseguradora>
            <SeguroEnVigor>S</SeguroEnVigor>
            </DatosAseguradora>
        </Datos>
        </TarificacionThirdPartyRequest>
        ';

        $this->assertXmlStringEqualsXmlString($expectedXml, $xml->asXML());
    }
}
