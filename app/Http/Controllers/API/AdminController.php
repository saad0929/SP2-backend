<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Repositories\AdminRepository;
use App\Repositories\EmployeeRepository;

class AdminController extends Controller
{

    private $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    public function store(CreateAdminRequest $request) {
        $admin = $this->adminRepository->storeAdmin($request->validated());
        return response()->json($admin, 201);
    }

    public function updateAdmin(UpdateAdminRequest $request) {
        $admin = $this->adminRepository->updateAdmin($request->validated());
        return response()->json($admin, 201);
    }

    public function fetchAdmins () {
        $admins = $this->adminRepository->getAdmins();

        return response()->json($admins, 200);
    }

    public function fetchPaginatedAdmins () {
        $admins = $this->adminRepository->getPaginatedAdmins();

        return response()->json($admins, 200);
    }

    public function fetchAdminById($admin_id) {
        $admin = $this->adminRepository->fetchAdminById($admin_id);

        return response()->json($admin, 200);
    }

}
