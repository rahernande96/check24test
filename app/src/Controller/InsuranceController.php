<?php
namespace App\Controller;

use App\Model\InsuranceDTO;
use App\Service\InsuranceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class InsuranceController extends AbstractController
{
    protected InsuranceService $insuranceService;

    /**
     * InsuranceController constructor.
     *
     * @param InsuranceService $insuranceService The insurance service.
     */
    public function __construct(
        InsuranceService $insuranceService,
    )
    {
        $this->insuranceService = $insuranceService;
    }

    #[Route('/insurance', methods: ['POST'])]
    public function index(
        #[MapRequestPayload] InsuranceDTO $insuranceDTO,
    ): Response
    {   
        $response = $this->insuranceService->requestInsuranceQuote($insuranceDTO);

        return new Response(
            json_encode($response), 
            Response::HTTP_OK, 
            ['content-type' => 'application/json']
        );

    }
}