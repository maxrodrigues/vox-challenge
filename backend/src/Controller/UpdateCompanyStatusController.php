<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateCompanyStatusController extends AbstractController
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private CompanyService $companyService,
    )
    {
        //
    }
    #[Route('/api/company/status/{companyId}', name: 'app_update_company_status', methods: ['PATCH'])]
    public function __invoke(int $companyId, Request $request): JsonResponse
    {
        try {
            $data = $request->toArray();
            $company = $this->companyService->isCompanyFound($companyId);

            match ($data['status']) {
                true => $this->companyService->activeCompany($company),
                false => $this->companyService->disableCompany($company),
            };

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Company updated successfully',
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ]
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
