# Alumni Connect — Laravel Platform Implementation Plan

Build a production-ready Laravel 11 alumni networking platform with authentication, profiles, messaging, mentorship, events, and admin dashboard — deployable on XAMPP.

## Proposed Changes

### Phase 1: Project Scaffolding & Database

#### [NEW] Laravel project initialization
- `composer create-project laravel/laravel .` in Alumni-Connection directory
- Configure `.env` for MySQL (XAMPP), set `DB_DATABASE=alumni_connect`
- Install Bootstrap 5 via npm for Blade templates

#### [NEW] Database Migrations (14 tables)
All migration files in `database/migrations/`:
1. `create_roles_table` — 5 roles (student, alumni, mentor, organizer, admin)
2. Modify `users` table — add `is_active`, soft deletes
3. `create_role_assignments_table` — stackable role pivot
4. `create_profiles_table` — graduation year, skills, mentor fields, soft deletes
5. `create_messages_table` — sender/receiver, read_at, soft deletes
6. `create_mentorships_table` — mentor/mentee, status enum, soft deletes
7. `create_mentorship_goals_table` — progress tracking
8. `create_mentorship_interactions_table` — notes, meetings, milestones
9. `create_events_table` — organizer, capacity, status, soft deletes
10. `create_event_registrations_table` — RSVP with unique constraint
11. `create_event_attendances_table` — check-in tracking
12. `create_activity_posts_table` — visibility enum, flagged, soft deletes
13. `create_flagged_contents_table` — polymorphic moderation
14. `create_audit_logs_table` — full change tracking

#### [NEW] Eloquent Models (12 models)
All in `app/Models/`:
- `User`, `Role`, `Profile`, `Message`, `Mentorship`, `MentorshipGoal`, `MentorshipInteraction`, `Event`, `EventRegistration`, `EventAttendance`, `ActivityPost`, `FlaggedContent`, `AuditLog`
- Each with proper `$fillable`, `$casts`, relationships, scopes

#### [NEW] Database Seeders
- `RoleSeeder` — 5 roles
- `SampleDataSeeder` — 7 test accounts, 20 random alumni, 6 events, 5 mentorships, 50+ messages, activity posts

---

### Phase 2: Authentication & Authorization

#### [NEW] Auth Controllers
- `app/Http/Controllers/Auth/RegisterController.php` — role selection, combination validation
- `app/Http/Controllers/Auth/LoginController.php` — active check, audit logging

#### [NEW] Middleware
- `app/Http/Middleware/CheckRole.php` — role gate with multi-role support
- `app/Http/Middleware/EnsureAccountActive.php` — disabled account blocking

#### [NEW] Services
- `app/Services/RoleService.php` — role combination validation logic

#### [NEW] Form Requests
- `StoreUserRequest`, `StoreEventRequest`, `StoreMessageRequest`, `StoreMentorshipRequest`, `StoreGoalRequest`

#### [NEW] Auth Blade Views
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`

---

### Phase 3: Core Feature Modules

#### [NEW] Profiles & Directory
- `ProfileController` — index (search/filter/paginate), show (role-filtered fields), edit, update
- `profiles/index.blade.php` — search form + paginated card grid
- `profiles/show.blade.php` — role-aware field visibility
- `profiles/edit.blade.php` — profile editor form

#### [NEW] Messaging System
- `MessageController` — inbox, conversation thread, send with role restrictions
- `messages/index.blade.php` — conversation list with unread badges
- `messages/show.blade.php` — threaded conversation with compose form

#### [NEW] Mentorship Program
- `MentorshipController` — browse mentors, request, respond, dashboard, terminate
- `GoalController` — CRUD for mentorship goals
- `app/Services/MentorMatchingService.php` — scoring algorithm (industry +40, field +30, location +15, skills +15)
- `mentorship/browse.blade.php` — filtered mentor list
- `mentorship/dashboard.blade.php` — relationships, goals, interactions

#### [NEW] Event Management
- `EventController` — CRUD, RSVP with transaction locking, attendance, reports
- `events/index.blade.php` — filterable event listing
- `events/show.blade.php` — detail + RSVP button
- `events/create.blade.php` / `events/edit.blade.php` — event forms
- `events/attendance.blade.php` — check-in management
- `events/report.blade.php` — attendance report

#### [NEW] Activity Feed
- `FeedController` — role-filtered feed, post creation
- `feed/index.blade.php` — feed with compose form

---

### Phase 4: Admin Dashboard

#### [NEW] Admin Controllers
- `AdminController` — dashboard stats, user management, role assignment, moderation

#### [NEW] Admin Views
- `admin/dashboard.blade.php` — analytics widgets
- `admin/users.blade.php` — user list with role/status management
- `admin/flagged.blade.php` — content moderation queue

---

### Phase 5: Layout, Navigation & Polish

#### [NEW] Layout & Components
- `resources/views/layouts/app.blade.php` — main layout with role-adaptive nav, unread badge
- `resources/views/components/` — reusable Blade components (cards, badges, alerts)
- `resources/views/dashboard.blade.php` — role-specific dashboard widgets
- `resources/views/welcome.blade.php` — landing page with hero, features, stats

#### [NEW] CSS & Frontend
- `resources/css/app.css` — design system (colors, typography, cards, buttons, forms)
- Bootstrap 5 + custom overrides matching UI/UX brief (navy/gold palette)

#### [NEW] Routes
- `routes/web.php` — all routes with middleware groups per TRD spec

---

### Phase 6: Security & Performance

- CSRF on all forms
- Rate limiting on login (5/min), registration (3/min), messages (30/min)
- Eager loading on all list queries
- `Model::preventLazyLoading()` in dev
- Audit logging for critical operations

## Verification Plan

### Automated Tests
- `php artisan migrate:fresh --seed` runs without errors
- `php artisan serve` starts successfully
- All routes resolve (no 500 errors)
- Login with each of the 7 test accounts

### Manual Verification
- Register new user with role selection
- Search directory with filters
- Send message (test student restrictions)
- Request mentorship + accept + set goals
- Create event + RSVP + track attendance
- Admin: manage users, assign roles, moderate content

> [!IMPORTANT]
> This is a large project with 14 database tables, 12 models, 6+ controllers, and 20+ Blade views. I'll build it incrementally — database first, then auth, then each feature module. Each phase will be verified before moving to the next.
