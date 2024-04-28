<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;

class UserController extends Controller
{
    protected $userService;
    protected $locationService;

    public function __construct(
        UserServiceInterface $userService,
        LocationServiceInterface $locationService,
    ) {
        $this->userService = $userService;
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->paginate();
        return view('admin.pages.user.users', [
            'users' => $users,
            'page' => 'Users',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $provinces = $this->locationService->getAllProvinces();
        return view('admin.pages.user.editUser', [
            'provinces' => $provinces,
            'user' => $user,
            'parentPage' => ['Users', 'admin.users.index'],
            'childPage' => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        if ($this->userService->update($user, $validatedData)) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        }
        return back()->withErrors('Failed to update user.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($this->userService->delete($user)) {
            return redirect()->route('admin.users.index')->with('success', 'Delete User successfully');
        }
        return back()->withErrors('Failed to delete user.');
    }
}
