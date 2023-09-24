<?php
namespace App\Command;

use App\Insurance\FooInsurance\FooInsuranceStrategy;
use App\Model\InsuranceDTO;
use App\Service\InsuranceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand(
    name: 'insurance:quote',
    description: 'Mapping json to XML',
)]
class InsuranceCommand extends Command
{
    protected function configure(): void
    {
        $this->addArgument('json', InputArgument::REQUIRED, 'Json Data');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonData = $input->getArgument('json');
        $insuranceDTO = $this->deserializeJson($jsonData, InsuranceDTO::class);
        $insuranceService = new InsuranceService(new FooInsuranceStrategy());
        $response = $insuranceService->requestInsuranceQuote($insuranceDTO);
        $output->writeln(json_encode($response));
        return Command::SUCCESS;
    }

    private function deserializeJson(string $jsonData, string $className): object
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->deserialize($jsonData, $className, 'json');
    }
}

