<?php

declare(strict_types=1);

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Company\Application\DataTransferObjects\CompanyData;
use Modules\Company\Application\UseCases\CreateCompany;
use Modules\Company\Application\UseCases\DeleteCompany;
use Modules\Company\Application\UseCases\GetCompany;
use Modules\Company\Application\UseCases\ListCompanies;
use Modules\Company\Application\UseCases\UpdateCompany;
use Modules\Company\Domain\Entities\Company;
use Modules\Company\Http\Requests\StoreCompanyRequest;
use Modules\Company\Http\Requests\UpdateCompanyRequest;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    public function index(ListCompanies $listCompanies): JsonResponse
    {
        $companies = array_map(
            fn(Company $company): array => $company->toArray(),
            $listCompanies->execute()
        );

        return response()->json(['data' => $companies]);
    }

    public function store(
        StoreCompanyRequest $request,
        CreateCompany $createCompany,
    ): JsonResponse {
        $company = $createCompany->execute(CompanyData::fromArray($request->validated()));
       

        return response()->json(
            ['data' => $company->toArray()],
            Response::HTTP_CREATED
        );
    }

    public function show(int $company, GetCompany $getCompany): JsonResponse
    {
        return response()->json([
            'data' => $getCompany->execute($company)->toArray(),
        ]);
    }

    public function update(
        UpdateCompanyRequest $request,
        int $company,
        UpdateCompany $updateCompany,
    ): JsonResponse {
        $updatedCompany = $updateCompany->execute(
            $company,
            CompanyData::fromArray($request->validated())
        );

        return response()->json([
            'data' => $updatedCompany->toArray(),
        ]);
    }

    public function destroy(int $company, DeleteCompany $deleteCompany): JsonResponse
    {
        $deleteCompany->execute($company);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
