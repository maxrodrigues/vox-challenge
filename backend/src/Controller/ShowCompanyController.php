<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShowCompanyController extends AbstractController
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    #[Route('/api/company/{companyId}', name: 'app_show_company', methods: ['GET'])]
    public function __invoke(int $companyId): JsonResponse
    {
        try {
            $company = $this->companyRepository->findOneBy(['id' => $companyId, 'isActive' => true]);

            if(! $company) {
                return new JsonResponse([
                    'status' => 'error',
                    'data' => [
                        'message' => 'Company not found',
                    ]
                ]);
            }

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'company' => $company->toArray(),
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
