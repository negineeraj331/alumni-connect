# Alumni Connect — Technical Requirements Document (TRD)

**Version:** 1.0 | **Date:** 2026-05-18 | **Stack:** Laravel 11 · MySQL 8 · XAMPP | **PHP:** 8.2+

---

## 1. Overview

### 1.1 Purpose
This TRD is the single source of truth for building a production-ready Laravel alumni networking platform. It covers architecture, database design, API contracts, feature specs, security, testing, and deployment.

### 1.2 Scope
Four core modules: (1) Authentication & Profiles, (2) Messaging & Communication, (3) Mentorship Program, (4) Event Management — plus an Admin Dashboard.

### 1.3 Roles
| Role | Slug | Description |
|------|------|-------------|
| Alumni | `alumni` | Graduates — full platform access |
| Mentor/Faculty | `mentor` | Staff — mentorship + event hosting |
| Student | `student` | Current students — limited access |
| Event Organizer | `organizer` | Event CRUD + attendance |
| Super Admin | `admin` | Full platform governance |

Roles are **stackable** (union permissions). Approved combos: `alumni+mentor`, `alumni+organizer`, `mentor+organizer`. Admin is exclusive.

---

## 2. System Architecture

### 2.1 High-Level Diagram

```
┌──────────────┐     ┌──────────────────────────────────────┐
│   Browser    │────▶│  Laravel 11 (Apache via XAMPP)        │
│  Blade Views │     │                                      │
└──────────────┘     │  ┌────────┐  ┌──────────┐  ┌──────┐ │
                     │  │ Routes │─▶│Controllers│─▶│Models│ │
                     │  └────────┘  └──────────┘  └──┬───┘ │
                     │  ┌────────┐  ┌──────────┐     │     │
                     │  │ Middle │  │ Services │     │     │
                     │  │ ware   │  │ Layer    │     │     │
                     │  └────────┘  └──────────┘     │     │
                     └───────────────────────────────┼─────┘
                                                     │
                                              ┌──────▼──────┐
                                              │  MySQL 8.0  │
                                              │  (XAMPP)    │
                                              └─────────────┘
```

### 2.2 Technology Stack
| Layer | Technology |
|-------|-----------|
| Framework | Laravel 11.x |
| PHP | 8.2+ |
| Database | MySQL 8.0 (via XAMPP) |
| Auth | Laravel Sanctum (API) + Session (Web) |
| Templating | Blade |
| CSS | Bootstrap 5.3 |
| Caching | File cache (default), Redis optional |
| Queue | Sync driver (XAMPP); database driver for production |
| Testing | PHPUnit + Laravel test helpers |

### 2.3 File Structure & Conventions

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/           # LoginController, RegisterController
│   │   ├── ProfileController.php
│   │   ├── MessageController.php
│   │   ├── MentorshipController.php
│   │   ├── EventController.php
│   │   └── Admin/          # AdminUserController, AdminAnalyticsController
│   ├── Middleware/
│   │   ├── CheckRole.php           # Role gate middleware
│   │   └── EnsureAccountActive.php # Disabled account check
│   └── Requests/           # Form Request validation classes
│       ├── StoreUserRequest.php
│       ├── StoreEventRequest.php
│       ├── StoreMessageRequest.php
│       └── StoreMentorshipRequest.php
├── Models/
│   ├── User.php
│   ├── Role.php
│   ├── Profile.php
│   ├── Message.php
│   ├── Mentorship.php
│   ├── MentorshipGoal.php
│   ├── Event.php
│   ├── EventRegistration.php
│   ├── ActivityPost.php
│   └── FlaggedContent.php
├── Services/
│   ├── MentorMatchingService.php
│   ├── RoleService.php
│   └── AnalyticsService.php
├── Policies/
│   ├── MessagePolicy.php
│   ├── EventPolicy.php
│   └── MentorshipPolicy.php
database/
├── migrations/             # Timestamped migrations
├── seeders/
│   ├── DatabaseSeeder.php
│   ├── RoleSeeder.php
│   └── SampleDataSeeder.php
resources/views/
├── layouts/app.blade.php
├── auth/                   # login, register
├── profiles/               # index, show, edit
├── messages/               # index, show
├── mentorship/             # index, dashboard, goals
├── events/                 # index, show, create, edit, attendance
└── admin/                  # dashboard, users, flagged
```

### 2.4 Naming Conventions
| Element | Convention | Example |
|---------|-----------|---------|
| Model | Singular PascalCase | `MentorshipGoal` |
| Controller | Singular + Controller | `EventController` |
| Migration | `create_{table}_table` | `create_mentorships_table` |
| Seeder | Descriptive + Seeder | `SampleDataSeeder` |
| Form Request | Store/Update + Entity | `StoreEventRequest` |
| Policy | Entity + Policy | `EventPolicy` |
| Middleware | Descriptive PascalCase | `CheckRole` |
| Routes | Plural resource nouns | `/events`, `/messages` |
| DB Tables | Plural snake_case | `mentorship_goals` |
| DB Columns | snake_case | `graduation_year` |
| Foreign Keys | `{singular}_id` | `mentor_id` |

---

## 3. Database Schema

### 3.1 Migration Execution Order
```
1. create_roles_table
2. create_users_table (modify: add is_active)
3. create_role_assignments_table
4. create_profiles_table
5. create_messages_table
6. create_mentorships_table
7. create_mentorship_goals_table
8. create_events_table
9. create_event_registrations_table
10. create_event_attendances_table
11. create_activity_posts_table
12. create_flagged_contents_table
```

### 3.2 Table Specifications

#### `roles`
```php
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name', 50)->unique();       // student, alumni, mentor, organizer, admin
    $table->string('display_name', 100);
    $table->text('description')->nullable();
    $table->timestamps();
});
```

#### `users` (modify default Laravel users table)
```php
Schema::table('users', function (Blueprint $table) {
    $table->boolean('is_active')->default(true)->after('password');
});
```

#### `role_assignments`
```php
Schema::create('role_assignments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('role_id')->constrained()->cascadeOnDelete();
    $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamp('assigned_at')->useCurrent();
    $table->unique(['user_id', 'role_id']);
    $table->index('user_id');
});
```

#### `profiles`
```php
Schema::create('profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
    $table->year('graduation_year')->nullable();
    $table->string('field_of_study')->nullable();
    $table->text('bio')->nullable();
    $table->string('location')->nullable();
    $table->string('phone', 20)->nullable();
    $table->string('linkedin_url')->nullable();
    $table->json('work_history')->nullable();    // [{company, title, start, end}]
    $table->json('skills')->nullable();          // ["PHP", "Laravel"]
    $table->boolean('mentor_availability')->default(false);
    $table->unsignedTinyInteger('mentor_capacity')->default(5);
    $table->json('mentor_industries')->nullable(); // ["Tech", "Finance"]
    $table->string('avatar_path')->nullable();
    $table->timestamps();
    $table->index('graduation_year');
    $table->index('field_of_study');
    $table->index('location');
});
```

#### `messages`
```php
Schema::create('messages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
    $table->text('body');
    $table->timestamp('read_at')->nullable();
    $table->timestamps();
    $table->index(['sender_id', 'receiver_id']);
    $table->index(['receiver_id', 'read_at']);
});
```

#### `mentorships`
```php
Schema::create('mentorships', function (Blueprint $table) {
    $table->id();
    $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('mentee_id')->constrained('users')->cascadeOnDelete();
    $table->enum('status', ['pending', 'active', 'declined', 'completed', 'terminated'])
          ->default('pending');
    $table->text('request_message')->nullable();
    $table->timestamp('responded_at')->nullable();
    $table->timestamp('ended_at')->nullable();
    $table->timestamps();
    $table->index('mentor_id');
    $table->index('mentee_id');
    $table->index('status');
});
```

#### `mentorship_goals`
```php
Schema::create('mentorship_goals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('mentorship_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->unsignedTinyInteger('progress')->default(0); // 0-100
    $table->timestamp('completed_at')->nullable();
    $table->timestamps();
});
```

#### `events`
```php
Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('category', 100)->nullable();
    $table->string('location')->nullable();
    $table->dateTime('event_date');
    $table->unsignedInteger('capacity')->nullable();
    $table->enum('status', ['active', 'cancelled', 'completed'])->default('active');
    $table->timestamps();
    $table->index('event_date');
    $table->index('category');
    $table->index('status');
});
```

#### `event_registrations`
```php
Schema::create('event_registrations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('event_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->enum('status', ['registered', 'waitlisted', 'cancelled'])->default('registered');
    $table->timestamps();
    $table->unique(['event_id', 'user_id']);
});
```

#### `event_attendances`
```php
Schema::create('event_attendances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('event_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->timestamp('checked_in_at')->useCurrent();
    $table->unique(['event_id', 'user_id']);
});
```

#### `activity_posts`
```php
Schema::create('activity_posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->text('content');
    $table->enum('visibility', ['all', 'alumni_only', 'mentors_only'])->default('all');
    $table->boolean('is_flagged')->default(false);
    $table->timestamps();
    $table->index('visibility');
});
```

#### `flagged_contents`
```php
Schema::create('flagged_contents', function (Blueprint $table) {
    $table->id();
    $table->string('content_type', 50); // post, message, event
    $table->unsignedBigInteger('content_id');
    $table->foreignId('reported_by')->constrained('users')->cascadeOnDelete();
    $table->text('reason');
    $table->enum('status', ['pending', 'resolved', 'dismissed'])->default('pending');
    $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
    $table->index(['content_type', 'content_id']);
    $table->index('status');
});
```

### 3.3 Eloquent Relationships

```php
// User.php
public function roles()       { return $this->belongsToMany(Role::class, 'role_assignments')->withPivot('assigned_at'); }
public function profile()     { return $this->hasOne(Profile::class); }
public function sentMessages() { return $this->hasMany(Message::class, 'sender_id'); }
public function receivedMessages() { return $this->hasMany(Message::class, 'receiver_id'); }
public function mentorships()  { return $this->hasMany(Mentorship::class, 'mentor_id'); }
public function menteeships()  { return $this->hasMany(Mentorship::class, 'mentee_id'); }
public function organizedEvents() { return $this->hasMany(Event::class, 'organizer_id'); }
public function eventRegistrations() { return $this->hasMany(EventRegistration::class); }
public function activityPosts() { return $this->hasMany(ActivityPost::class); }

public function hasRole(string $role): bool {
    return $this->roles()->where('name', $role)->exists();
}

public function hasAnyRole(array $roles): bool {
    return $this->roles()->whereIn('name', $roles)->exists();
}

// Mentorship.php
public function mentor()  { return $this->belongsTo(User::class, 'mentor_id'); }
public function mentee()  { return $this->belongsTo(User::class, 'mentee_id'); }
public function goals()   { return $this->hasMany(MentorshipGoal::class); }

// Event.php
public function organizer()     { return $this->belongsTo(User::class, 'organizer_id'); }
public function registrations() { return $this->hasMany(EventRegistration::class); }
public function attendances()   { return $this->hasMany(EventAttendance::class); }
public function isFull(): bool  { return $this->capacity && $this->registrations()->where('status','registered')->count() >= $this->capacity; }
```

### 3.4 Eager Loading Requirements
Always eager-load these relationships to prevent N+1:

| Context | Eager Load |
|---------|-----------|
| Profile directory listing | `User::with('profile', 'roles')` |
| Message thread | `Message::with('sender:id,name')` |
| Mentorship dashboard | `Mentorship::with('mentor.profile', 'mentee.profile', 'goals')` |
| Event listing | `Event::with('organizer:id,name')->withCount('registrations')` |
| Admin user list | `User::with('roles', 'profile')` |

---

## 4. Authentication & Authorization

### 4.1 Auth Implementation

**Registration Flow:**
1. User submits name, email, password, role(s), profile fields
2. `StoreUserRequest` validates input + role combination
3. DB transaction: create user → create profile → attach roles via `role_assignments`
4. Issue Sanctum token (API) or start session (web)
5. Redirect to role-appropriate dashboard

**Login Flow:**
1. Validate credentials
2. Check `is_active` — reject disabled accounts with `403`
3. Create session/token
4. Redirect based on primary role (admin → admin dashboard, else → home)

### 4.2 Middleware

#### `CheckRole` Middleware
```php
// app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, string ...$roles): Response
{
    if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
        abort(403, 'You do not have permission to access this resource.');
    }
    return $next($request);
}

// Usage in routes:
Route::middleware('role:admin')->group(/* admin routes */);
Route::middleware('role:mentor,alumni')->group(/* mentor or alumni routes */);
```

#### `EnsureAccountActive` Middleware
```php
public function handle(Request $request, Closure $next): Response
{
    if ($request->user() && !$request->user()->is_active) {
        Auth::logout();
        return redirect('/login')->withErrors(['Account suspended. Contact admin.']);
    }
    return $next($request);
}
```

Register in `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => CheckRole::class,
        'active' => EnsureAccountActive::class,
    ]);
    $middleware->append(EnsureAccountActive::class); // Global
})
```

### 4.3 Role Combination Validation
```php
// app/Services/RoleService.php
class RoleService
{
    private const INVALID_COMBOS = [
        ['student', 'alumni'],
        ['student', 'mentor'],
        ['student', 'organizer'],
        ['admin', 'student'],
        ['admin', 'alumni'],
        ['admin', 'mentor'],
        ['admin', 'organizer'],
    ];

    public static function validateCombination(array $roleNames): bool
    {
        foreach (self::INVALID_COMBOS as $invalid) {
            if (count(array_intersect($roleNames, $invalid)) === count($invalid)) {
                return false;
            }
        }
        return true;
    }
}
```

### 4.4 Permission Matrix

| Permission | student | alumni | mentor | organizer | admin |
|-----------|---------|--------|--------|-----------|-------|
| `profile.view.own` | ✅ | ✅ | ✅ | ✅ | ✅ |
| `profile.view.limited` | ✅ | — | — | — | — |
| `profile.view.full` | — | ✅ | ✅ | ✅ | ✅ |
| `profile.edit.own` | ✅ | ✅ | ✅ | ✅ | ✅ |
| `profile.edit.any` | — | — | — | — | ✅ |
| `message.send.connected` | ✅ | ✅ | ✅ | ✅ | ✅ |
| `message.send.any` | — | ✅ | — | — | ✅ |
| `feed.view.events` | ✅ | ✅ | ✅ | ✅ | ✅ |
| `feed.view.all` | — | ✅ | ✅ | ✅ | ✅ |
| `feed.post` | — | ✅ | ✅ | ✅ | ✅ |
| `mentor.request` | ✅ | ✅ | — | — | — |
| `mentor.offer` | — | ✅ | ✅ | — | — |
| `mentor.manage` | — | ✅ | ✅ | — | — |
| `event.create` | — | — | ✅ | ✅ | ✅ |
| `event.rsvp` | ✅ | ✅ | ✅ | ✅ | ✅ |
| `event.attendance.own` | — | — | — | ✅ | — |
| `event.attendance.all` | — | — | — | — | ✅ |
| `admin.*` | — | — | — | — | ✅ |

---

## 5. Data Validation Rules

### 5.1 User Registration — `StoreUserRequest`
```php
public function rules(): array
{
    return [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email|max:255',
        'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
        'roles'    => 'required|array|min:1',
        'roles.*'  => 'exists:roles,name',
        'graduation_year' => 'nullable|integer|min:1950|max:' . date('Y'),
        'field_of_study'  => 'nullable|string|max:255',
        'bio'      => 'nullable|string|max:2000',
        'location' => 'nullable|string|max:255',
        'phone'    => 'nullable|string|max:20|regex:/^[\d\s\+\-\(\)]+$/',
    ];
}

public function withValidator(Validator $validator): void
{
    $validator->after(function ($v) {
        if (!RoleService::validateCombination($this->input('roles', []))) {
            $v->errors()->add('roles', 'This role combination is not permitted.');
        }
    });
}
```

### 5.2 Event Creation — `StoreEventRequest`
```php
public function rules(): array
{
    return [
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string|max:5000',
        'category'    => 'nullable|string|max:100',
        'location'    => 'required|string|max:255',
        'event_date'  => 'required|date|after:now',
        'capacity'    => 'nullable|integer|min:1|max:10000',
    ];
}
```

### 5.3 Send Message — `StoreMessageRequest`
```php
public function rules(): array
{
    return [
        'body' => 'required|string|min:1|max:5000',
    ];
}
```

### 5.4 Mentorship Request — `StoreMentorshipRequest`
```php
public function rules(): array
{
    return [
        'mentor_id'       => 'required|exists:users,id',
        'request_message' => 'nullable|string|max:2000',
        'goals'           => 'nullable|array|max:5',
        'goals.*'         => 'string|max:255',
    ];
}
```

### 5.5 Mentorship Goal — `StoreGoalRequest`
```php
public function rules(): array
{
    return [
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'progress'    => 'integer|between:0,100',
    ];
}
```
