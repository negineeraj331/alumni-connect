<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use App\Models\AuditLog;
use App\Services\RoleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $requestedRoles = $validated['roles'];

        // Validate Role Combination via Service
        if (!$this->roleService->validateCombination($requestedRoles)) {
            return back()->withInput()->withErrors(['roles' => 'This combination of roles is not permitted.']);
        }

        try {
            DB::transaction(function () use ($validated, $requestedRoles) {
                // 1. Create User
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'is_active' => true,
                ]);

                // 2. Create Profile
                Profile::create([
                    'user_id' => $user->id,
                    'graduation_year' => $validated['graduation_year'] ?? null,
                    'field_of_study' => $validated['field_of_study'] ?? null,
                    'location' => $validated['location'] ?? null,
                    'mentor_availability' => in_array('mentor', $requestedRoles),
                ]);

                // 3. Assign Roles
                $roleIds = Role::whereIn('name', $requestedRoles)->pluck('id');
                $user->roles()->attach($roleIds);

                // Log audit trail manually since user isn't logged in yet to use standard static method easily
                AuditLog::create([
                    'user_id' => $user->id,
                    'action' => 'registered',
                    'auditable_type' => User::class,
                    'auditable_id' => $user->id,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'created_at' => now(),
                ]);

                Auth::login($user);
            });

            return redirect()->route('dashboard')->with('success', 'Registration successful!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }
}
