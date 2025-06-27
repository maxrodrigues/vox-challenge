<?php

namespace App\Controller;

use App\Service\CompanyService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteCompanyController extends AbstractController
{
    public function __construct(private CompanyService $companyService)
    {
        //
    }
    #[Route('/api/company/{companyId}', name: 'app_delete_company', methods: ['DELETE'])]
    public function __invoke(int $companyId): JsonResponse
    {
        try {
            $company = $this->companyService->isCompanyFound($companyId);
            $this->companyService->deleteCompany($company);

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Company deleted successfully',
                ]
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ]
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
