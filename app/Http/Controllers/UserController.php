<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    protected $categoryService;
    protected $locationService;
    protected $imageService;

    public function __construct(
        UserServiceInterface $userService,
        CategoryServiceInterface $categoryService,
        LocationServiceInterface $locationService,
        ImageServiceInterface $imageService,
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->locationService = $locationService;
        $this->imageService = $imageService;
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
        // dd($provinces);
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


    public function editProfile()
    {
        $provinces = $this->locationService->getAllProvinces();
        $categories = $this->categoryService->getAll();

        // $user = User::find(Auth::user()->id)->load(['province', 'district', 'ward']);
        $user = Auth::user()->load(['province', 'district', 'ward']);

        // dd($user->provincee);
        return view('shop.pages.profile', [
            'provinces' => $provinces,
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar') && $user->avatar) {
            $this->imageService->deleteImage($user->avatar);
        }
        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $this->imageService->storeAvatar($request);
            $validatedData['avatar'] = $path;
        }

        // dd($validatedData);

        if ($this->userService->update($user, $validatedData)) {
            return redirect()->route('user.editProfile')->with('success', 'Profile updated successfully');
        }

        return back()->withErrors('Failed to update profile.');
    }
}
