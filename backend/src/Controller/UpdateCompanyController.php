<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateCompanyController extends AbstractController
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    #[Route('/api/company/{companyId}', name: 'app_update_company', methods: ['PUT'])]
    public function __invoke(int $companyId, Request $request): JsonResponse
    {
        try {
            $data = $request->toArray();
            if (! $data) {
                return new JsonResponse([
                    'status' => 'error',
                    'data' => [
                        'message' => 'No data provided',
                    ]
                ], Response::HTTP_BAD_REQUEST);
            }

            $company = $this->companyRepository->findOneBy(['id' => $companyId, 'isActive' => true]);

            if (! $company) {
                return new JsonResponse([
                    'status' => 'error',
                    'data' => [
                        'message' => 'Company not found',
                    ]
                ], Response::HTTP_NOT_FOUND);
            }

            $this->companyRepository->updateCompany($company, $data);

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Update company',
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
