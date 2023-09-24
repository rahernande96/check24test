<?php
namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class InsuranceCommandTest extends KernelTestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('insurance:quote');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecute(): void
    {
        $json = '{
            "holder": "CONDUCTOR_PRINCIPAL",
            "occasionalDriver": "SI",
            "prevInsurance_contractDate": "2013-03-03",
            "prevInsurance_expirationDate": "2021-03-02",
            "prevInsurance_exists": "SI"
        }';

        $this->commandTester->execute(['json' => $json]);

        $this->assertCommandIsSuccessful();
        $this->assertOutputContainsXml();
    }

    private function assertCommandIsSuccessful(): void
    {
        $this->commandTester->assertCommandIsSuccessful();
    }

    private function assertOutputContainsXml(): void
    {
        $output = $this->commandTester->getDisplay();
        $expectedXml = '<?xml version=\"1.0\"?>\n<TarificacionThirdPartyRequest><Datos><DatosGenerales><CondPpalEsTomador>N<\/CondPpalEsTomador><ConductorUnico>N<\/ConductorUnico><FecCot>'.date('c').'<\/FecCot><NroCondOca>1<\/NroCondOca><AnosSegAnte>8<\/AnosSegAnte><\/DatosGenerales><DatosAseguradora><SeguroEnVigor>S<\/SeguroEnVigor><\/DatosAseguradora><\/Datos><\/TarificacionThirdPartyRequest>\n';

        $this->assertStringContainsString($expectedXml, $output);
    }
}