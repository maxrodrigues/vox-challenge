<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateCompanyController extends AbstractController
{
    public function __construct(private CompanyService $companyService)
    {

    }
    #[Route('/api/list/company', name: 'app_create_company', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->toArray();

        match ($this->havePartner($data)) {
            true => $this->companyService->createCompanyAndPartner($data),
            false => $this->companyService->createCompany($data),
        };
        return new JsonResponse([
            'status' => 'success',
            'data' => [
                'message' => 'Company created successfully'
            ],
        ], Response::HTTP_CREATED);
    }

    private function havePartner(array $payload): bool
    {
        if (array_key_exists('partner', $payload)) {
            return true;
        }

        return false;
    }
}
