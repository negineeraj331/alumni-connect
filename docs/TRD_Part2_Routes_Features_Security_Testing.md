# Alumni Connect — TRD Part 2: Routes, Feature Specs, Security, Testing & Deployment

---

## 6. Route & API Design

### 6.1 Web Routes (`routes/web.php`)

```php
// Public
Route::get('/', fn() => view('welcome'));
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated (all roles)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profiles
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');

    // Activity Feed
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::post('/feed', [FeedController::class, 'store'])->name('feed.store')
         ->middleware('role:alumni,mentor,organizer,admin');

    // Events (browsing + RSVP for all)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/rsvp', [EventController::class, 'rsvp'])->name('events.rsvp');
    Route::delete('/events/{event}/rsvp', [EventController::class, 'cancelRsvp'])->name('events.cancel-rsvp');

    // Mentorship (browsing for eligible roles)
    Route::get('/mentors', [MentorshipController::class, 'browseMentors'])->name('mentors.index');
    Route::get('/mentorship', [MentorshipController::class, 'dashboard'])->name('mentorship.dashboard');
    Route::post('/mentorship/request', [MentorshipController::class, 'requestMentor'])
         ->name('mentorship.request')->middleware('role:student,alumni');
    Route::patch('/mentorship/{mentorship}/respond', [MentorshipController::class, 'respond'])
         ->name('mentorship.respond')->middleware('role:mentor,alumni');
    Route::delete('/mentorship/{mentorship}', [MentorshipController::class, 'terminate'])
         ->name('mentorship.terminate');
    Route::post('/mentorship/{mentorship}/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::patch('/mentorship/{mentorship}/goals/{goal}', [GoalController::class, 'update'])->name('goals.update');

    // Event Management (organizer/mentor/admin)
    Route::middleware('role:organizer,mentor,admin')->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::get('/events/{event}/attendance', [EventController::class, 'attendance'])->name('events.attendance');
        Route::post('/events/{event}/attendance', [EventController::class, 'recordAttendance'])->name('events.record-attendance');
        Route::get('/events/{event}/report', [EventController::class, 'report'])->name('events.report');
    });

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/roles', [AdminController::class, 'updateRoles'])->name('users.roles');
        Route::patch('/users/{user}/status', [AdminController::class, 'toggleStatus'])->name('users.status');
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/flagged', [AdminController::class, 'flagged'])->name('flagged');
        Route::patch('/flagged/{flagged}', [AdminController::class, 'resolveFlagged'])->name('flagged.resolve');
    });
});
```

### 6.2 API Endpoints Summary

| Method | Endpoint | Auth | Roles | Status Codes |
|--------|----------|------|-------|-------------|
| POST | `/register` | No | Public | 201, 422 |
| POST | `/login` | No | Public | 200, 401, 403 |
| POST | `/logout` | Yes | Any | 200 |
| GET | `/profiles` | Yes | Any | 200 |
| GET | `/profiles/{id}` | Yes | Any (filtered) | 200, 404 |
| PUT | `/profiles/{id}` | Yes | Owner/Admin | 200, 403, 422 |
| GET | `/messages` | Yes | Any | 200 |
| GET | `/messages/{userId}` | Yes | Any (restricted) | 200, 403 |
| POST | `/messages/{userId}` | Yes | Any (restricted) | 201, 403, 422 |
| GET | `/feed` | Yes | Any (filtered) | 200 |
| POST | `/feed` | Yes | alumni,mentor,org,admin | 201, 403, 422 |
| GET | `/mentors` | Yes | Any | 200 |
| POST | `/mentorship/request` | Yes | student,alumni | 201, 403, 422 |
| PATCH | `/mentorship/{id}/respond` | Yes | mentor,alumni | 200, 403, 422 |
| DELETE | `/mentorship/{id}` | Yes | Participant | 200, 403 |
| POST | `/mentorship/{id}/goals` | Yes | Participant | 201, 422 |
| PATCH | `/mentorship/{id}/goals/{gid}` | Yes | Participant | 200, 422 |
| GET | `/events` | Yes | Any | 200 |
| POST | `/events` | Yes | org,mentor,admin | 201, 403, 422 |
| PUT | `/events/{id}` | Yes | Owner/Admin | 200, 403, 422 |
| DELETE | `/events/{id}` | Yes | Owner/Admin | 200, 403 |
| POST | `/events/{id}/rsvp` | Yes | Any | 201, 403, 422 |
| DELETE | `/events/{id}/rsvp` | Yes | Any | 200 |
| POST | `/events/{id}/attendance` | Yes | Owner/Admin | 200, 403 |
| GET | `/events/{id}/report` | Yes | Owner/Admin | 200, 403 |
| GET | `/admin/users` | Yes | admin | 200, 403 |
| PATCH | `/admin/users/{id}/roles` | Yes | admin | 200, 403, 422 |
| PATCH | `/admin/users/{id}/status` | Yes | admin | 200, 403 |
| GET | `/admin/analytics` | Yes | admin | 200 |

---

## 7. Feature Specifications

### 7.1 Authentication & Profiles

**Controller:** `ProfileController`

**Directory Search Logic:**
```php
public function index(Request $request)
{
    $query = User::with('profile', 'roles')
        ->where('is_active', true);

    if ($search = $request->input('search')) {
        $query->where('name', 'LIKE', "%{$search}%");
    }
    if ($year = $request->input('graduation_year')) {
        $query->whereHas('profile', fn($q) => $q->where('graduation_year', $year));
    }
    if ($field = $request->input('field_of_study')) {
        $query->whereHas('profile', fn($q) => $q->where('field_of_study', 'LIKE', "%{$field}%"));
    }
    if ($role = $request->input('role')) {
        $query->whereHas('roles', fn($q) => $q->where('name', $role));
    }
    if ($location = $request->input('location')) {
        $query->whereHas('profile', fn($q) => $q->where('location', 'LIKE', "%{$location}%"));
    }

    $users = $query->paginate(20);

    // Role-based field filtering handled in Blade view
    return view('profiles.index', compact('users'));
}
```

**Profile Field Visibility (Blade):**
```blade
{{-- profiles/show.blade.php --}}
<h2>{{ $user->name }}</h2>
<p>{{ $user->profile->field_of_study }} — Class of {{ $user->profile->graduation_year }}</p>
<p>{{ $user->profile->bio }}</p>
<p>{{ $user->profile->location }}</p>

@unless(auth()->user()->hasRole('student'))
    {{-- Alumni, Mentors, Organizers, Admins see extended info --}}
    <p>Email: {{ $user->email }}</p>
    <p>Phone: {{ $user->profile->phone }}</p>
    <p>LinkedIn: {{ $user->profile->linkedin_url }}</p>
    <h4>Work History</h4>
    @foreach($user->profile->work_history ?? [] as $job)
        <p>{{ $job['title'] }} at {{ $job['company'] }}</p>
    @endforeach
@endunless
```

### 7.2 Messaging System

**Controller:** `MessageController`

**Sending Logic with Role Restrictions:**
```php
public function store(Request $request, User $user)
{
    $request->validate(['body' => 'required|string|min:1|max:5000']);
    $sender = auth()->user();

    // Student can only message connected mentors
    if ($sender->hasRole('student') && !$sender->hasAnyRole(['alumni','admin'])) {
        $isConnected = Mentorship::where('mentee_id', $sender->id)
            ->where('mentor_id', $user->id)
            ->where('status', 'active')
            ->exists();

        if (!$isConnected) {
            return back()->withErrors(['You can only message your connected mentors.']);
        }
    }

    // Check recipient is active
    if (!$user->is_active) {
        return back()->withErrors(['This user is no longer active.']);
    }

    Message::create([
        'sender_id'   => $sender->id,
        'receiver_id' => $user->id,
        'body'        => $request->body,
    ]);

    return redirect()->route('messages.show', $user)->with('success', 'Message sent.');
}
```

**Conversation Listing:**
```php
public function index()
{
    $userId = auth()->id();
    // Get latest message per conversation partner
    $conversations = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->with(['sender:id,name', 'receiver:id,name'])
        ->latest()
        ->get()
        ->groupBy(fn($m) => $m->sender_id === $userId ? $m->receiver_id : $m->sender_id)
        ->map(fn($msgs) => $msgs->first());

    $unreadCount = Message::where('receiver_id', $userId)->whereNull('read_at')->count();

    return view('messages.index', compact('conversations', 'unreadCount'));
}
```

### 7.3 Mentorship Program

**Matching Algorithm — `MentorMatchingService`:**
```php
class MentorMatchingService
{
    public function findMatches(User $mentee, array $filters = []): Collection
    {
        return User::whereHas('roles', fn($q) => $q->whereIn('name', ['mentor', 'alumni']))
            ->whereHas('profile', fn($q) => $q->where('mentor_availability', true))
            ->with('profile')
            ->get()
            ->filter(function ($mentor) {
                // Exclude mentors at capacity
                $activeCount = $mentor->mentorships()->where('status', 'active')->count();
                return $activeCount < ($mentor->profile->mentor_capacity ?? 5);
            })
            ->map(function ($mentor) use ($mentee, $filters) {
                $score = 0;
                $menteeProfile = $mentee->profile;
                $mentorProfile = $mentor->profile;

                // Industry match (+40 points)
                if (!empty($filters['industry']) && !empty($mentorProfile->mentor_industries)) {
                    if (in_array($filters['industry'], $mentorProfile->mentor_industries)) {
                        $score += 40;
                    }
                }

                // Field of study match (+30 points)
                if ($menteeProfile->field_of_study === $mentorProfile->field_of_study) {
                    $score += 30;
                }

                // Location match (+15 points)
                if ($menteeProfile->location === $mentorProfile->location) {
                    $score += 15;
                }

                // Skills overlap (+15 points)
                $overlap = array_intersect(
                    $menteeProfile->skills ?? [],
                    $mentorProfile->skills ?? []
                );
                $score += min(count($overlap) * 5, 15);

                $mentor->match_score = $score;
                return $mentor;
            })
            ->sortByDesc('match_score')
            ->take(10);
    }
}
```

**Request Mentorship:**
```php
public function requestMentor(StoreMentorshipRequest $request)
{
    $mentee = auth()->user();
    $mentorId = $request->mentor_id;

    // Check student limit (max 2 active)
    if ($mentee->hasRole('student') && !$mentee->hasRole('alumni')) {
        $activeCount = $mentee->menteeships()->where('status', 'active')->count();
        if ($activeCount >= 2) {
            return back()->withErrors(['Maximum active mentorships reached (limit: 2).']);
        }
    }

    // Check duplicate
    $exists = Mentorship::where('mentee_id', $mentee->id)
        ->where('mentor_id', $mentorId)
        ->whereIn('status', ['pending', 'active'])
        ->exists();
    if ($exists) {
        return back()->withErrors(['A mentorship with this mentor already exists.']);
    }

    // Check 30-day cooldown after decline
    $declined = Mentorship::where('mentee_id', $mentee->id)
        ->where('mentor_id', $mentorId)
        ->where('status', 'declined')
        ->where('responded_at', '>', now()->subDays(30))
        ->exists();
    if ($declined) {
        return back()->withErrors(['Please wait 30 days before re-requesting this mentor.']);
    }

    $mentorship = Mentorship::create([
        'mentor_id' => $mentorId,
        'mentee_id' => $mentee->id,
        'request_message' => $request->request_message,
    ]);

    return redirect()->route('mentorship.dashboard')->with('success', 'Request sent.');
}
```

### 7.4 Event Management

**RSVP with Capacity Handling:**
```php
public function rsvp(Event $event)
{
    if ($event->status !== 'active') {
        return back()->withErrors(['This event has been cancelled.']);
    }

    $userId = auth()->id();

    // Duplicate check
    $existing = EventRegistration::where('event_id', $event->id)
        ->where('user_id', $userId)->first();
    if ($existing && $existing->status === 'registered') {
        return back()->withErrors(['Already registered for this event.']);
    }

    // Capacity check with row locking
    $status = DB::transaction(function () use ($event, $userId) {
        $event->lockForUpdate();
        $currentCount = $event->registrations()->where('status', 'registered')->count();

        $regStatus = ($event->capacity && $currentCount >= $event->capacity)
            ? 'waitlisted' : 'registered';

        EventRegistration::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => $userId],
            ['status' => $regStatus]
        );

        return $regStatus;
    });

    $msg = $status === 'waitlisted'
        ? 'Event is full. You have been added to the waitlist.'
        : 'Successfully registered!';

    return back()->with('success', $msg);
}
```

**Attendance Recording:**
```php
public function recordAttendance(Request $request, Event $event)
{
    $this->authorize('manageAttendance', $event); // Policy check

    $request->validate(['user_ids' => 'required|array', 'user_ids.*' => 'exists:users,id']);

    foreach ($request->user_ids as $userId) {
        EventAttendance::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => $userId],
            ['checked_in_at' => now()]
        );
    }

    return back()->with('success', 'Attendance recorded.');
}
```

---

## 8. Security Requirements

| Requirement | Implementation |
|------------|---------------|
| **CSRF** | All forms use `@csrf` directive; enabled globally |
| **SQL Injection** | Eloquent ORM only; no raw queries with user input |
| **XSS** | Blade `{{ }}` auto-escapes; `{!! !!}` prohibited for user content |
| **Passwords** | bcrypt via `Hash::make()`; min 8 chars with complexity regex |
| **Rate Limiting** | `RateLimiter::for('login', fn() => Limit::perMinute(5))` |
| **Mass Assignment** | All models use `$fillable` arrays |
| **Auth Tokens** | Sanctum tokens with expiration; session regeneration on login |
| **File Uploads** | Validate MIME type, max 2MB; store in `storage/app/public` |
| **Logging** | Log: logins, role changes, admin actions, permission violations |
| **Headers** | `X-Frame-Options: DENY`, `X-Content-Type-Options: nosniff` |

**Rate Limiting Config (`AppServiceProvider`):**
```php
RateLimiter::for('login', fn(Request $r) => Limit::perMinute(5)->by($r->ip()));
RateLimiter::for('messages', fn(Request $r) => Limit::perMinute(30)->by($r->user()?->id));
RateLimiter::for('registration', fn(Request $r) => Limit::perMinute(3)->by($r->ip()));
```

---

## 9. Performance & Optimization

| Strategy | Details |
|----------|---------|
| **Eager Loading** | All list queries use `with()` — see §3.4 |
| **Database Indexes** | Applied on: `email`, `graduation_year`, `field_of_study`, `event_date`, `status`, FKs |
| **Pagination** | Default 20 per page, max 100; all list endpoints paginated |
| **Query Caching** | Directory: 5 min cache key `profiles:search:{hash}`; Analytics: 15 min |
| **N+1 Prevention** | Use `preventLazyLoading()` in `AppServiceProvider::boot()` during dev |
| **Select Optimization** | Use `select()` to limit columns: `User::select('id','name','email')` |

```php
// AppServiceProvider.php boot()
Model::preventLazyLoading(!app()->isProduction());
```

---

## 10. Error Handling

### 10.1 Standard Response Format
```php
// Success
return response()->json(['message' => 'Resource created', 'data' => $resource], 201);

// Validation Error (automatic via Form Requests)
{ "message": "Validation failed", "errors": { "email": ["The email field is required."] } } // 422

// Auth Error
{ "message": "Unauthenticated." } // 401

// Permission Error
{ "message": "You do not have permission to access this resource." } // 403

// Not Found
{ "message": "Resource not found." } // 404

// Rate Limited
{ "message": "Too many requests. Try again in 60 seconds." } // 429
```

### 10.2 Exception Handler (`bootstrap/app.php`)
```php
->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (ModelNotFoundException $e) {
        return response()->json(['message' => 'Resource not found.'], 404);
    });
    $exceptions->render(function (AuthorizationException $e) {
        return response()->json(['message' => $e->getMessage()], 403);
    });
})
```

---

## 11. Testing Strategy

### 11.1 Coverage Targets
| Area | Target |
|------|--------|
| Models & relationships | 90% |
| Controllers | 85% |
| Middleware | 100% |
| Services | 90% |
| Validation | 100% |

### 11.2 Key Test Cases

```php
// tests/Feature/AuthTest.php
public function test_register_with_valid_data(): void
{
    $response = $this->post('/register', [
        'name' => 'Test User', 'email' => 'test@test.com',
        'password' => 'Test@1234', 'password_confirmation' => 'Test@1234',
        'roles' => ['alumni'],
    ]);
    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
}

public function test_register_rejects_invalid_role_combo(): void
{
    $response = $this->post('/register', [
        'name' => 'Bad Combo', 'email' => 'bad@test.com',
        'password' => 'Test@1234', 'password_confirmation' => 'Test@1234',
        'roles' => ['student', 'mentor'],
    ]);
    $response->assertSessionHasErrors('roles');
}

public function test_disabled_user_cannot_login(): void
{
    $user = User::factory()->create(['is_active' => false]);
    $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
    $response->assertSessionHasErrors();
}

// tests/Feature/MessageTest.php
public function test_student_cannot_message_non_mentor(): void
{
    $student = $this->createUserWithRole('student');
    $alumni = $this->createUserWithRole('alumni');
    $response = $this->actingAs($student)->post("/messages/{$alumni->id}", ['body' => 'Hi']);
    $response->assertSessionHasErrors();
}

// tests/Feature/EventTest.php
public function test_rsvp_full_event_gets_waitlisted(): void
{
    $event = Event::factory()->create(['capacity' => 1]);
    EventRegistration::factory()->create(['event_id' => $event->id, 'status' => 'registered']);
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post("/events/{$event->id}/rsvp");
    $this->assertDatabaseHas('event_registrations', [
        'event_id' => $event->id, 'user_id' => $user->id, 'status' => 'waitlisted'
    ]);
}

public function test_student_cannot_create_event(): void
{
    $student = $this->createUserWithRole('student');
    $response = $this->actingAs($student)->post('/events', ['title' => 'Test']);
    $response->assertForbidden();
}

// tests/Feature/MentorshipTest.php
public function test_student_limited_to_two_mentorships(): void
{
    $student = $this->createUserWithRole('student');
    Mentorship::factory()->count(2)->create(['mentee_id' => $student->id, 'status' => 'active']);
    $mentor = $this->createUserWithRole('mentor');
    $response = $this->actingAs($student)->post('/mentorship/request', ['mentor_id' => $mentor->id]);
    $response->assertSessionHasErrors();
}
```

### 11.3 Running Tests
```bash
php artisan test                          # All tests
php artisan test --filter=AuthTest        # Specific suite
php artisan test --coverage               # With coverage report
```

---

## 12. Seeders

```php
// database/seeders/RoleSeeder.php
public function run(): void
{
    $roles = ['student', 'alumni', 'mentor', 'organizer', 'admin'];
    foreach ($roles as $role) {
        Role::firstOrCreate(['name' => $role], [
            'display_name' => ucfirst($role),
            'description'  => ucfirst($role) . ' role',
        ]);
    }
}

// database/seeders/SampleDataSeeder.php — creates test accounts
// admin@alumni.test / alumni@alumni.test / student@alumni.test
// mentor@alumni.test / organizer@alumni.test
// alumnimentor@alumni.test (multi-role) / alumniorg@alumni.test (multi-role)
// + 20 random alumni, 5 events, 10 mentorships, 50 messages
```

---

## 13. Deployment on XAMPP

### 13.1 Prerequisites
- XAMPP 8.2+ (Apache + MySQL)
- Composer 2.x
- Node.js 18+ and npm
- Git

### 13.2 Step-by-Step Setup
```bash
# 1. Clone into htdocs
cd C:\xampp\htdocs   # Windows — or /Applications/XAMPP/htdocs on Mac
git clone <repo-url> alumni-connect
cd alumni-connect

# 2. Install dependencies
composer install
npm install && npm run build

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Configure .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=alumni_connect
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Create database via phpMyAdmin or CLI
mysql -u root -e "CREATE DATABASE alumni_connect;"

# 6. Migrate and seed
php artisan migrate
php artisan db:seed

# 7. Storage link
php artisan storage:link

# 8. Serve
php artisan serve
# Visit http://127.0.0.1:8000
```

### 13.3 Test Accounts (Post-Seed)
| Role(s) | Email | Password |
|---------|-------|----------|
| Admin | admin@alumni.test | password |
| Alumni | alumni@alumni.test | password |
| Student | student@alumni.test | password |
| Mentor | mentor@alumni.test | password |
| Organizer | organizer@alumni.test | password |
| Alumni+Mentor | alumnimentor@alumni.test | password |
| Alumni+Organizer | alumniorg@alumni.test | password |

### 13.4 Production Checklist
- [ ] `APP_ENV=production`, `APP_DEBUG=false`
- [ ] Unique `APP_KEY`
- [ ] MySQL credentials secured (not root)
- [ ] `php artisan optimize` (cache config, routes, views)
- [ ] `php artisan storage:link`
- [ ] HTTPS configured
- [ ] Default admin password changed
- [ ] Rate limiting active
- [ ] Log channel set to `daily`
- [ ] Mail driver configured for notifications

### 13.5 Environment Variables Reference
| Key | Dev Value | Prod Value |
|-----|-----------|-----------|
| APP_ENV | local | production |
| APP_DEBUG | true | false |
| DB_DATABASE | alumni_connect | alumni_connect |
| DB_USERNAME | root | (secure user) |
| CACHE_DRIVER | file | file or redis |
| QUEUE_CONNECTION | sync | database |
| MAIL_MAILER | log | smtp |
| SESSION_LIFETIME | 120 | 120 |
