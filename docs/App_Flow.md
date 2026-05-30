# Alumni Connect — Application Flow Document

**Version:** 1.0 | **Date:** 2026-05-18 | **Stack:** Laravel 11 · MySQL 8 · Blade · XAMPP

---

## 1. Application Overview

Alumni Connect is a Laravel-based networking platform enabling graduates, students, faculty, and administrators to maintain institutional connections through mentorship, events, messaging, and a searchable alumni directory.

### 1.1 Core Modules
| # | Module | Priority | Description |
|---|--------|----------|-------------|
| 1 | Authentication & Profiles | High | RBAC, registration, searchable directory |
| 2 | Messaging & Communication | High | DMs, conversation threads, activity feed |
| 3 | Mentorship Program | High | Matching, goals, dashboards, progress |
| 4 | Event Management | High | CRUD, RSVP, attendance, reporting |
| 5 | Admin Dashboard | High | User mgmt, analytics, moderation |

All features are **equally prioritized** for the MVP.

---

## 2. User Roles & Access Levels

| Role | Access Level | Key Capabilities |
|------|-------------|-----------------|
| **Alumni** | Full | Directory, messaging, mentorship, events, feed |
| **Student** | Limited | Browse directory (limited fields), request mentors (max 2), RSVP events |
| **Mentor/Faculty** | Elevated | Manage mentees, host events, mentor dashboard |
| **Event Organizer** | Specialized | Event CRUD, attendance tracking, reports |
| **Super Admin** | Unrestricted | User management, analytics, moderation, platform config |

---

## 3. Complete User Flows

### 3.1 Registration & Onboarding Flow

```
┌─────────────┐    ┌──────────────────┐    ┌───────────────────┐
│  Landing     │───▶│  Registration     │───▶│  Role Selection    │
│  Page        │    │  Form             │    │  (checkboxes)      │
└─────────────┘    └──────────────────┘    └────────┬──────────┘
                                                     │
                                          ┌──────────▼──────────┐
                                          │  Validate Role       │
                                          │  Combination         │
                                          └──────────┬──────────┘
                                                     │
                                    ┌────────────────┼────────────────┐
                                    │ Valid           │                │ Invalid
                              ┌─────▼─────┐    ┌─────▼──────┐  ┌─────▼──────┐
                              │ Create     │    │ Create      │  │ Show Error │
                              │ User       │    │ Profile     │  │ "Invalid   │
                              │ Account    │──▶│ Record      │  │  combo"    │
                              └───────────┘    └──────┬──────┘  └────────────┘
                                                      │
                                               ┌──────▼──────┐
                                               │ Assign Roles │
                                               │ (stackable)  │
                                               └──────┬──────┘
                                                      │
                                               ┌──────▼──────┐
                                               │ Redirect to  │
                                               │ Dashboard    │
                                               └─────────────┘
```

**Steps:**
1. User visits `/register`
2. Fills name, email, password, selects role(s)
3. Conditional profile fields appear (graduation year for alumni, expertise for mentors)
4. Server validates role combination against approved pairs
5. DB transaction: create user → profile → role_assignments
6. Session created; redirect to role-appropriate dashboard

**Error Paths:**
- Duplicate email → 422 "Email already registered"
- Invalid role combo (student+mentor) → 422 "This role combination is not permitted"
- Weak password → 422 with specific rule violations

---

### 3.2 Login Flow

```
┌──────────┐    ┌────────────┐    ┌──────────────┐    ┌────────────┐
│ Login    │───▶│ Validate   │───▶│ Check        │───▶│ Create     │
│ Form     │    │ Credentials│    │ is_active    │    │ Session    │
└──────────┘    └─────┬──────┘    └──────┬───────┘    └─────┬──────┘
                      │                  │                   │
                 ┌────▼────┐       ┌─────▼──────┐     ┌─────▼──────┐
                 │ Invalid │       │ Disabled   │     │ Route by   │
                 │ → 401   │       │ → 403      │     │ Role       │
                 └─────────┘       └────────────┘     └─────┬──────┘
                                                            │
                                          ┌─────────────────┼──────────┐
                                          │                 │          │
                                    ┌─────▼────┐    ┌──────▼───┐  ┌──▼──────┐
                                    │ Admin    │    │ Standard │  │ Multi-  │
                                    │ Dashboard│    │ Dashboard│  │ Role    │
                                    └──────────┘    └──────────┘  │ Merged  │
                                                                  │ Dashboard│
                                                                  └─────────┘
```

**Rate Limit:** 5 attempts/minute per IP. Lockout after 5 failures for 60 seconds.

---

### 3.3 Alumni Directory & Profile Flow

```
┌──────────┐    ┌──────────────────────┐    ┌────────────────┐
│ Directory│───▶│ Search/Filter Panel   │───▶│ Results Grid   │
│ Page     │    │ • Name search         │    │ (paginated,    │
│ /profiles│    │ • Graduation year     │    │  20/page)      │
└──────────┘    │ • Field of study      │    └───────┬────────┘
                │ • Location            │            │
                │ • Role filter         │     ┌──────▼───────┐
                └──────────────────────┘     │ Profile Card │
                                             │ (click)      │
                                             └──────┬───────┘
                                                    │
                                  ┌─────────────────┼─────────────────┐
                                  │ Student View     │ Alumni/Mentor    │
                                  │ (limited)        │ View (full)      │
                              ┌───▼─────────┐   ┌───▼──────────────┐
                              │ Name, Year  │   │ Name, Year, Bio  │
                              │ Field, Bio  │   │ Email, Phone     │
                              │ Location    │   │ Work History     │
                              │             │   │ Skills, LinkedIn │
                              └─────────────┘   └──────────────────┘
```

**Query Optimization:**
- Eager load: `User::with('profile', 'roles')`
- Index columns: `graduation_year`, `field_of_study`, `location`
- Cache search results: 5-min TTL with query-hash key

---

### 3.4 Messaging Flow

```
┌──────────────┐    ┌────────────────┐    ┌─────────────────┐
│ Inbox        │───▶│ Conversation   │───▶│ Compose Message │
│ /messages    │    │ Thread         │    │                 │
│              │    │ /messages/{id} │    └────────┬────────┘
│ Shows:       │    │                │             │
│ • Contacts   │    │ Shows:         │      ┌──────▼──────┐
│ • Unread     │    │ • Full history │      │ Validate    │
│   badge      │    │ • Paginated    │      │ Permissions │
│ • Last msg   │    │ • Read status  │      └──────┬──────┘
└──────────────┘    └────────────────┘             │
                                        ┌──────────┼──────────┐
                                        │ Allowed  │          │ Blocked
                                  ┌─────▼────┐         ┌─────▼──────┐
                                  │ Save     │         │ 403 Error  │
                                  │ Message  │         │ "Cannot    │
                                  │ to DB    │         │  message"  │
                                  └──────────┘         └────────────┘
```

**Permission Rules:**
| Sender Role | Can Message |
|------------|-------------|
| Alumni | Any active user |
| Student | Connected mentors only |
| Mentor | Any active user in mentorship context |
| Admin | Any user |

---

### 3.5 Mentorship Program Flow

```
                    ┌───────────────────────┐
                    │  MENTEE FLOW          │
                    │                       │
┌──────────┐       │  ┌────────────────┐   │
│ Browse   │───────┼─▶│ Filter Mentors │   │
│ Mentors  │       │  │ by industry,   │   │
│ /mentors │       │  │ goals, skills  │   │
└──────────┘       │  └───────┬────────┘   │
                   │          │             │
                   │  ┌───────▼────────┐   │
                   │  │ Matching       │   │
                   │  │ Algorithm      │   │
                   │  │ (scored list)  │   │
                   │  └───────┬────────┘   │
                   │          │             │
                   │  ┌───────▼────────┐   │
                   │  │ Send Request   │   │
                   │  │ + message      │   │
                   │  └───────┬────────┘   │
                   └──────────┼────────────┘
                              │
               ┌──────────────▼──────────────┐
               │  MENTOR FLOW                │
               │                             │
               │  ┌────────────────────┐     │
               │  │ Review Request     │     │
               │  │ (dashboard)        │     │
               │  └─────────┬──────────┘     │
               │            │                │
               │     ┌──────┼──────┐         │
               │     │             │         │
               │ ┌───▼───┐   ┌────▼────┐    │
               │ │Accept │   │Decline  │    │
               │ │→active│   │→declined│    │
               │ └───┬───┘   └─────────┘    │
               └─────┼──────────────────────┘
                     │
              ┌──────▼──────┐
              │ ACTIVE       │
              │ MENTORSHIP   │
              │              │
              │ • Set Goals  │
              │ • Track %    │
              │ • Log Notes  │
              │ • Message    │
              │ • Terminate  │
              └──────────────┘
```

**Matching Algorithm Scoring:**
| Factor | Points | Logic |
|--------|--------|-------|
| Industry match | +40 | Exact match on mentor_industries |
| Field of study match | +30 | Same field_of_study |
| Location match | +15 | Same location |
| Skills overlap | +15 | 5 pts per shared skill (max 15) |

**Constraints:**
- Students: max 2 active mentorships
- Alumni: unlimited
- Mentors: configurable capacity (default 5)
- 30-day cooldown after decline before re-requesting

---

### 3.6 Event Management Flow

```
┌────────────────────────────────────────────────────────────┐
│  ORGANIZER FLOW                                            │
│                                                            │
│  ┌─────────┐   ┌──────────┐   ┌────────────┐             │
│  │ Create  │──▶│ Set      │──▶│ Publish    │             │
│  │ Event   │   │ Details  │   │ Event      │             │
│  │ /create │   │ + Cap.   │   │            │             │
│  └─────────┘   └──────────┘   └─────┬──────┘             │
│                                      │                     │
│                               ┌──────▼──────┐             │
│                               │ Manage      │             │
│                               │ • Edit      │             │
│                               │ • Cancel    │             │
│                               │ • Attendance│             │
│                               │ • Report    │             │
│                               └─────────────┘             │
└────────────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────────────┐
│  ATTENDEE FLOW                                             │
│                                                            │
│  ┌──────────┐   ┌──────────────┐   ┌───────────────┐     │
│  │ Browse   │──▶│ Filter by    │──▶│ Event Detail  │     │
│  │ Events   │   │ date/category│   │ Page          │     │
│  │ /events  │   │ /location    │   │               │     │
│  └──────────┘   └──────────────┘   └───────┬───────┘     │
│                                             │              │
│                                      ┌──────▼──────┐      │
│                                      │ RSVP Button │      │
│                                      └──────┬──────┘      │
│                                             │              │
│                              ┌──────────────┼───────┐     │
│                              │              │       │     │
│                        ┌─────▼────┐  ┌──────▼──┐ ┌──▼──┐ │
│                        │Registered│  │Waitlist │ │Error│ │
│                        │ (< cap)  │  │(= cap)  │ │     │ │
│                        └──────────┘  └─────────┘ └─────┘ │
└────────────────────────────────────────────────────────────┘
```

**RSVP Concurrency:** Uses `DB::transaction()` with `lockForUpdate()` to prevent race conditions at capacity boundary.

**Event States:** `active` → `completed` (after event_date) | `active` → `cancelled` (by organizer/admin)

---

### 3.7 Activity Feed Flow

```
┌──────────────┐    ┌────────────────────────────────┐
│ Feed Page    │    │ Visibility Rules               │
│ /feed        │    │                                │
│              │    │ Student: event posts only       │
│ • Post form │    │ Alumni: all posts               │
│   (if allowed)   │ Mentor: all posts               │
│ • Post list │    │ Admin: all posts + flagged      │
│   (filtered)│    └────────────────────────────────┘
└──────┬───────┘
       │
┌──────▼───────┐    ┌────────────────┐
│ Create Post  │───▶│ Set Visibility │
│ (alumni,     │    │ • all          │
│  mentor,     │    │ • alumni_only  │
│  organizer,  │    │ • mentors_only │
│  admin)      │    └────────────────┘
└──────────────┘
```

---

### 3.8 Admin Dashboard Flow

```
┌──────────────────────────────────────────────┐
│  ADMIN DASHBOARD  /admin                      │
│                                               │
│  ┌─────────────┐  ┌──────────────────────┐   │
│  │ Analytics   │  │ Quick Stats          │   │
│  │ • Total     │  │ • Active mentorships │   │
│  │   users     │  │ • Events this month  │   │
│  │ • By role   │  │ • Messages today     │   │
│  │ • Growth    │  │ • Flagged items      │   │
│  └─────────────┘  └──────────────────────┘   │
│                                               │
│  ┌──────────────────────────────────────────┐ │
│  │ User Management  /admin/users            │ │
│  │ • Search/filter by role, status, date    │ │
│  │ • Assign/revoke roles (validate combos)  │ │
│  │ • Enable/disable accounts                │ │
│  │ • View user activity logs                │ │
│  └──────────────────────────────────────────┘ │
│                                               │
│  ┌──────────────────────────────────────────┐ │
│  │ Content Moderation  /admin/flagged       │ │
│  │ • Flagged posts, messages, events        │ │
│  │ • Approve / Remove actions               │ │
│  │ • Notify content author                  │ │
│  └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
```

---

## 4. Application Page Map

| Route | Page | Roles | Blade Template |
|-------|------|-------|---------------|
| `/` | Landing page | Public | `welcome.blade.php` |
| `/login` | Login form | Public | `auth/login.blade.php` |
| `/register` | Registration form | Public | `auth/register.blade.php` |
| `/dashboard` | Role-aware dashboard | All auth | `dashboard.blade.php` |
| `/profiles` | Alumni directory | All auth | `profiles/index.blade.php` |
| `/profiles/{id}` | Profile detail | All auth | `profiles/show.blade.php` |
| `/profiles/{id}/edit` | Edit profile | Owner/Admin | `profiles/edit.blade.php` |
| `/messages` | Inbox | All auth | `messages/index.blade.php` |
| `/messages/{id}` | Conversation | All auth | `messages/show.blade.php` |
| `/feed` | Activity feed | All auth | `feed/index.blade.php` |
| `/mentors` | Browse mentors | All auth | `mentorship/browse.blade.php` |
| `/mentorship` | Mentorship dashboard | Participants | `mentorship/dashboard.blade.php` |
| `/events` | Event listing | All auth | `events/index.blade.php` |
| `/events/create` | Create event | Org/Mentor/Admin | `events/create.blade.php` |
| `/events/{id}` | Event detail + RSVP | All auth | `events/show.blade.php` |
| `/events/{id}/edit` | Edit event | Owner/Admin | `events/edit.blade.php` |
| `/events/{id}/attendance` | Attendance mgmt | Owner/Admin | `events/attendance.blade.php` |
| `/events/{id}/report` | Event report | Owner/Admin | `events/report.blade.php` |
| `/admin` | Admin dashboard | Admin | `admin/dashboard.blade.php` |
| `/admin/users` | User management | Admin | `admin/users.blade.php` |
| `/admin/flagged` | Content moderation | Admin | `admin/flagged.blade.php` |

---

## 5. Navigation Structure

```
┌──────────────────────────────────────────────────────┐
│  NAVBAR (role-adaptive)                               │
│                                                       │
│  [Logo]  Directory  Events  Feed  Messages(3)  [User]│
│                                                       │
│  Additional items by role:                            │
│  • Student: Mentors                                   │
│  • Alumni: Mentors | My Mentorships                   │
│  • Mentor: My Mentees                                 │
│  • Organizer: My Events                               │
│  • Admin: Admin Panel                                 │
└──────────────────────────────────────────────────────┘
```

**Unread Badge:** Message icon shows unread count via `$unreadCount` shared to layout.

---

## 6. Data Flow Summary

```
User Action          →  Controller Method     →  Service/Model        →  Response
─────────────────────────────────────────────────────────────────────────────────
Register             →  RegisterController     →  User + Profile +     →  Redirect /dashboard
                        @register                 RoleAssignment
Login                →  LoginController        →  Auth::attempt()      →  Redirect /dashboard
                        @login
Search Directory     →  ProfileController      →  User::with('profile')→  Blade view
                        @index                    ->paginate(20)
Send Message         →  MessageController      →  Permission check +   →  Redirect /messages/{id}
                        @store                    Message::create()
Request Mentor       →  MentorshipController   →  Limit check + cooldown→ Redirect /mentorship
                        @requestMentor            + Mentorship::create()
RSVP Event           →  EventController        →  Capacity lock + reg  →  Redirect /events/{id}
                        @rsvp                     DB::transaction()
Create Event         →  EventController        →  Event::create()      →  Redirect /events/{id}
                        @store
Admin Toggle Status  →  AdminController        →  User->is_active      →  Redirect /admin/users
                        @toggleStatus             toggle + log
```

---

## 7. Error Handling Flow

```
┌───────────┐    ┌──────────────┐    ┌─────────────────┐
│ User      │───▶│ Form Request │───▶│ Validation Pass? │
│ Submits   │    │ Validation   │    └────────┬─────────┘
│ Form      │    └──────────────┘             │
└───────────┘                         ┌───────┼───────┐
                                      │ Yes   │       │ No
                                ┌─────▼────┐  │ ┌─────▼──────┐
                                │Controller│  │ │ 422 +      │
                                │ Logic    │  │ │ field errors│
                                └─────┬────┘  │ │ back()     │
                                      │       │ └────────────┘
                               ┌──────▼──────┐│
                               │ Policy/     ││
                               │ Permission  ││
                               │ Check       ││
                               └──────┬──────┘│
                                      │       │
                               ┌──────┼───────┘
                               │ Pass │ Fail
                         ┌─────▼───┐ ┌▼─────────┐
                         │ Execute │ │ 403 abort │
                         │ Action  │ └───────────┘
                         └─────┬───┘
                               │
                        ┌──────▼──────┐
                        │ Success     │
                        │ Redirect +  │
                        │ Flash msg   │
                        └─────────────┘
```

| Code | When | User Sees |
|------|------|-----------|
| 401 | Not logged in | Redirect to `/login` |
| 403 | Wrong role/permission | "You do not have permission" |
| 404 | Resource not found | "Page not found" |
| 422 | Validation failure | Field-level error messages |
| 429 | Rate limited | "Too many attempts, try again later" |
| 500 | Server error | Generic error page (details logged) |
