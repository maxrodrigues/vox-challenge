<?php

namespace App\Controller\Partner;

use App\Repository\CompanyRepository;
use App\Repository\PartnerRepository;
use App\Service\HelperService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateController extends AbstractController
{
    public function __construct(
        private PartnerRepository $partnerRepository,
        private CompanyRepository $companyRepository,
    )
    {
        //
    }
    #[Route('/api/partner/create', name: 'app_partner_create', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = $request->toArray();
            $this->partnerRepository->createNewPartner($data);

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Partner successfully created.',
                ],
            ], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
