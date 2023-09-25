<?php
namespace App\Controller;

use App\DTOs\InsuranceDTO;
use App\Service\InsuranceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use OpenApi\Attributes as OA;

#[Route('/api')]
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
    #[OA\Response(
        response: 200,
        description: 'Returns the insurance mapped',
        content: new OA\XmlContent()
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(
                    property: "holder", 
                    type: "string",
                    example: "CONDUCTOR_PRINCIPAL"
                ),
                new OA\Property(
                    property: "occasionalDriver", 
                    type: "string",
                    example: "SI"
                ),
                new OA\Property(
                    property: "prevInsurance_contractDate", 
                    type: "string",
                    example: "2013-03-03"
                ),
                new OA\Property(
                    property: "prevInsurance_expirationDate", 
                    type: "string",
                    example: "2021-03-02"
                ),
                new OA\Property(
                    property: "prevInsurance_exists", 
                    type: "string",
                    example: "SI"
                ),
            ]
        )
    )]
    #[OA\Tag(name: 'Insurance')]
    public function index(
        #[MapRequestPayload] InsuranceDTO $insuranceDTO,
    ): Response
    {   
        $response = $this->insuranceService->requestInsuranceQuote($insuranceDTO);

        return new Response(
            $response, 
            Response::HTTP_OK, 
            ['content-type' => 'application/xml']
        );

    }
}