<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListCompanyController extends AbstractController
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    #[Route('api/list/company', name: 'app_list_company')]
    public function __invoke(): JsonResponse
    {
        $company = $this->companyRepository->findAllActiveCompanies();

        return $this->json([
            'status' => 'success',
            'data' => [
                'companies' => $company
            ],
        ], Response::HTTP_OK);

    }
}
