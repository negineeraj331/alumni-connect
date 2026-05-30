# Alumni Connect Platform — PRD Part 2: Permissions, API, Database & Technical Requirements

---

## 4. Access Control & Permissions Matrix

### 4.1 Feature Permissions by Role

| Feature | Student | Alumni | Mentor/Faculty | Event Organizer | Super Admin |
|---------|---------|--------|----------------|-----------------|-------------|
| **View own profile** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Edit own profile** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **View directory (limited)** | ✅ | — | — | — | — |
| **View directory (full)** | — | ✅ | ✅ | ✅ | ✅ |
| **Message connected users** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Message any user** | — | ✅ | — | — | ✅ |
| **Post to activity feed** | — | ✅ | ✅ | ✅ | ✅ |
| **View full feed** | — | ✅ | ✅ | ✅ | ✅ |
| **View events-only feed** | ✅ | — | — | — | — |
| **Request mentor** | ✅ | ✅ | — | — | — |
| **Offer mentorship** | — | ✅ | ✅ | — | — |
| **Accept/decline mentees** | — | ✅ | ✅ | — | — |
| **View mentorship dashboard** | ✅ (own) | ✅ (own) | ✅ (own) | — | ✅ (all) |
| **Create events** | — | — | ✅ | ✅ | ✅ |
| **RSVP to events** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Track event attendance** | — | — | — | ✅ (own events) | ✅ (all) |
| **Cancel events** | — | — | — | ✅ (own events) | ✅ (all) |
| **View admin dashboard** | — | — | — | — | ✅ |
| **Manage users** | — | — | — | — | ✅ |
| **Assign/revoke roles** | — | — | — | — | ✅ |
| **Moderate content** | — | — | — | — | ✅ |
| **View platform analytics** | — | — | — | — | ✅ |

### 4.2 Stackable Role Resolution

When a user holds **Alumni + Mentor/Faculty**, they get the union:
- Full directory access (Alumni) + mentorship management (Mentor)
- Message any user (Alumni) + mentor dashboard (Mentor)

When a user holds **Alumni + Event Organizer**, they get:
- Full networking (Alumni) + event CRUD and attendance tracking (Organizer)

### 4.3 Permission Scopes

| Scope | Description | Applies To |
|-------|-------------|------------|
| `own` | Can only access own resources | All roles for profiles, messages |
| `connected` | Can access connected users' resources | Students for messaging |
| `owned-events` | Can manage only self-created events | Event Organizer |
| `all` | Can access all resources system-wide | Super Admin only |

---

## 5. API Specification

### 5.1 Authentication

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| POST | `/api/auth/register` | Public | Register new user |
| POST | `/api/auth/login` | Public | Login and get token |
| POST | `/api/auth/logout` | Authenticated | Invalidate session |
| GET | `/api/auth/me` | Authenticated | Get current user + roles |

#### POST `/api/auth/register`
```json
// Request
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "SecurePass1!",
  "password_confirmation": "SecurePass1!",
  "roles": ["alumni", "mentor"],
  "graduation_year": 2020,
  "field_of_study": "Computer Science"
}

// Success Response (201)
{
  "message": "Registration successful",
  "user": { "id": 1, "name": "Jane Doe", "roles": ["alumni", "mentor"] },
  "token": "Bearer ..."
}

// Error Response (422)
{
  "message": "Validation failed",
  "errors": {
    "roles": ["The combination student + mentor is not permitted."],
    "email": ["The email has already been taken."]
  }
}
```

**Rate Limit:** 5 requests/minute per IP for registration, 10/minute for login.

### 5.2 Profiles & Directory

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| GET | `/api/profiles` | Authenticated | Search/filter directory |
| GET | `/api/profiles/{id}` | Authenticated | View profile (role-filtered fields) |
| PUT | `/api/profiles/{id}` | Owner / Admin | Update profile |

#### GET `/api/profiles`
```
Query: ?search=john&graduation_year=2020&field=Engineering&role=alumni&page=1&per_page=20
```
```json
// Success (200)
{
  "data": [
    {
      "id": 1, "name": "John Smith", "graduation_year": 2020,
      "field_of_study": "Engineering", "roles": ["alumni"],
      "location": "New York"
      // Students won't see: email, phone, work_history
    }
  ],
  "meta": { "current_page": 1, "last_page": 5, "total": 100 }
}
```

**Caching:** Directory queries cached for 5 minutes; invalidated on profile update.

### 5.3 Messaging

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| GET | `/api/messages` | Authenticated | List conversations |
| GET | `/api/messages/{userId}` | Authenticated | Get thread with user |
| POST | `/api/messages/{userId}` | Authenticated | Send message |
| PATCH | `/api/messages/{id}/read` | Authenticated | Mark as read |

#### POST `/api/messages/{userId}`
```json
// Request
{ "body": "Hello, I'd love to connect about your career in AI." }

// Success (201)
{ "id": 42, "from": 1, "to": 5, "body": "...", "read_at": null, "created_at": "..." }

// Error (403) - Student messaging non-mentor
{ "message": "You can only message your connected mentors." }
```

**Rate Limit:** 30 messages/minute per user.

### 5.4 Mentorship

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| GET | `/api/mentors` | Authenticated | Browse available mentors |
| POST | `/api/mentorship/request` | Student, Alumni | Request mentorship |
| PATCH | `/api/mentorship/{id}/respond` | Mentor | Accept/decline |
| GET | `/api/mentorship/dashboard` | Authenticated | View relationships |
| POST | `/api/mentorship/{id}/goals` | Both parties | Add goal |
| PATCH | `/api/mentorship/{id}/goals/{goalId}` | Both parties | Update goal progress |
| DELETE | `/api/mentorship/{id}` | Both parties | End mentorship |

#### POST `/api/mentorship/request`
```json
// Request
{ "mentor_id": 10, "message": "I'd like guidance on data science careers.", "goals": ["Career transition", "Skill development"] }

// Success (201)
{ "id": 7, "mentor_id": 10, "mentee_id": 1, "status": "pending", "created_at": "..." }

// Error (422) - At capacity
{ "message": "Maximum active mentorships reached (limit: 2 for students)." }
```

### 5.5 Events

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| GET | `/api/events` | Authenticated | Browse/filter events |
| POST | `/api/events` | Organizer, Mentor, Admin | Create event |
| PUT | `/api/events/{id}` | Owner / Admin | Update event |
| DELETE | `/api/events/{id}` | Owner / Admin | Cancel event |
| POST | `/api/events/{id}/rsvp` | Authenticated | RSVP to event |
| DELETE | `/api/events/{id}/rsvp` | Authenticated | Cancel RSVP |
| POST | `/api/events/{id}/attendance` | Organizer (owner) | Record attendance |
| GET | `/api/events/{id}/report` | Organizer (owner) / Admin | Attendance report |

#### POST `/api/events`
```json
// Request
{
  "title": "Tech Alumni Meetup 2026",
  "description": "Annual networking event",
  "date": "2026-07-15T18:00:00Z",
  "location": "Main Auditorium",
  "capacity": 100,
  "category": "networking"
}

// Success (201)
{ "id": 15, "title": "...", "organizer_id": 3, "rsvp_count": 0, "status": "active" }

// Error (403)
{ "message": "Students cannot create events." }
```

### 5.6 Admin

| Method | Endpoint | Roles | Description |
|--------|----------|-------|-------------|
| GET | `/api/admin/users` | Admin | List/search users |
| PATCH | `/api/admin/users/{id}/roles` | Admin | Update user roles |
| PATCH | `/api/admin/users/{id}/status` | Admin | Enable/disable user |
| GET | `/api/admin/analytics` | Admin | Platform statistics |
| GET | `/api/admin/flagged` | Admin | Flagged content queue |
| PATCH | `/api/admin/flagged/{id}` | Admin | Resolve flagged item |

---

## 6. Database Schema

### 6.1 Entity Relationship Diagram

```
users ──1:M──> role_assignments ──M:1──> roles
users ──1:1──> profiles
users ──1:M──> messages (as sender)
users ──1:M──> messages (as receiver)
users ──1:M──> mentorships (as mentor)
users ──1:M──> mentorships (as mentee)
mentorships ──1:M──> mentorship_goals
users ──1:M──> events (as organizer)
events ──1:M──> event_registrations ──M:1──> users
events ──1:M──> event_attendances ──M:1──> users
users ──1:M──> activity_feed_posts
```

### 6.2 Tables

#### `users`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT |
| name | VARCHAR(255) | NOT NULL |
| email | VARCHAR(255) | UNIQUE, NOT NULL |
| password | VARCHAR(255) | NOT NULL (hashed) |
| is_active | BOOLEAN | DEFAULT true |
| email_verified_at | TIMESTAMP | NULLABLE |
| remember_token | VARCHAR(100) | NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

#### `roles`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| name | VARCHAR(50) | UNIQUE (student, alumni, mentor, organizer, admin) |
| display_name | VARCHAR(100) | |
| description | TEXT | NULLABLE |

#### `role_assignments` (Stackable Role Pivot)
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| user_id | BIGINT UNSIGNED | FK → users, INDEX |
| role_id | BIGINT UNSIGNED | FK → roles |
| assigned_by | BIGINT UNSIGNED | FK → users, NULLABLE |
| assigned_at | TIMESTAMP | |
| UNIQUE(user_id, role_id) | | |

#### `profiles`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| user_id | BIGINT UNSIGNED | FK → users, UNIQUE |
| graduation_year | YEAR | NULLABLE |
| field_of_study | VARCHAR(255) | NULLABLE |
| bio | TEXT | NULLABLE |
| location | VARCHAR(255) | NULLABLE |
| phone | VARCHAR(20) | NULLABLE |
| linkedin_url | VARCHAR(255) | NULLABLE |
| work_history | JSON | NULLABLE |
| skills | JSON | NULLABLE |
| mentor_availability | BOOLEAN | DEFAULT false |
| mentor_capacity | INT | DEFAULT 5 |
| mentor_industries | JSON | NULLABLE |
| avatar_path | VARCHAR(255) | NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

#### `messages`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| sender_id | BIGINT UNSIGNED | FK → users, INDEX |
| receiver_id | BIGINT UNSIGNED | FK → users, INDEX |
| body | TEXT | NOT NULL |
| read_at | TIMESTAMP | NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

#### `mentorships`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| mentor_id | BIGINT UNSIGNED | FK → users, INDEX |
| mentee_id | BIGINT UNSIGNED | FK → users, INDEX |
| status | ENUM('pending','active','declined','completed','terminated') | DEFAULT 'pending' |
| request_message | TEXT | NULLABLE |
| responded_at | TIMESTAMP | NULLABLE |
| ended_at | TIMESTAMP | NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

#### `mentorship_goals`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| mentorship_id | BIGINT UNSIGNED | FK → mentorships |
| title | VARCHAR(255) | NOT NULL |
| description | TEXT | NULLABLE |
| progress | TINYINT UNSIGNED | DEFAULT 0 (0-100) |
| completed_at | TIMESTAMP | NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

#### `events`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| organizer_id | BIGINT UNSIGNED | FK → users |
| title | VARCHAR(255) | NOT NULL |
| description | TEXT | NULLABLE |
| category | VARCHAR(100) | INDEX |
| location | VARCHAR(255) | |
| event_date | DATETIME | NOT NULL, INDEX |
| capacity | INT UNSIGNED | NULLABLE |
| status | ENUM('active','cancelled','completed') | DEFAULT 'active' |
| created_at / updated_at | TIMESTAMPS | |

#### `event_registrations`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| event_id | BIGINT UNSIGNED | FK → events |
| user_id | BIGINT UNSIGNED | FK → users |
| status | ENUM('registered','waitlisted','cancelled') | DEFAULT 'registered' |
| created_at | TIMESTAMP | |
| UNIQUE(event_id, user_id) | | |

#### `event_attendances`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| event_id | BIGINT UNSIGNED | FK → events |
| user_id | BIGINT UNSIGNED | FK → users |
| checked_in_at | TIMESTAMP | |
| UNIQUE(event_id, user_id) | | |

#### `activity_feed_posts`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| user_id | BIGINT UNSIGNED | FK → users |
| content | TEXT | NOT NULL |
| visibility | ENUM('all','alumni_only','mentors_only') | DEFAULT 'all' |
| is_flagged | BOOLEAN | DEFAULT false |
| created_at / updated_at | TIMESTAMPS | |

#### `flagged_content`
| Column | Type | Constraints |
|--------|------|------------|
| id | BIGINT UNSIGNED | PK |
| content_type | VARCHAR(50) | (post, message, event) |
| content_id | BIGINT UNSIGNED | |
| reported_by | BIGINT UNSIGNED | FK → users |
| reason | TEXT | |
| status | ENUM('pending','resolved','dismissed') | DEFAULT 'pending' |
| resolved_by | BIGINT UNSIGNED | FK → users, NULLABLE |
| created_at / updated_at | TIMESTAMPS | |

---

## 7. Technical Requirements

### 7.1 Security
- **Authentication:** Laravel Sanctum for API tokens; session-based auth for web
- **Password:** Minimum 8 chars, 1 uppercase, 1 number, 1 special character; bcrypt hashed
- **CSRF:** Token protection on all POST/PUT/PATCH/DELETE forms
- **SQL Injection:** Eloquent ORM with parameterized queries exclusively
- **XSS:** All output escaped via Blade `{{ }}` syntax
- **Rate Limiting:** Configurable per endpoint (see API spec)
- **Logging:** Log all logins, role changes, permission violations, and admin actions

### 7.2 Performance Targets
- API response time: < 200ms for standard queries
- Directory search: < 500ms with indexed columns
- Use eager loading (`with()`) to prevent N+1 queries
- Cache directory results (5 min TTL), analytics (15 min TTL)
- Paginate all list endpoints (default 20, max 100)

### 7.3 Validation Rules Summary
| Field | Rules |
|-------|-------|
| email | required, email format, unique in users table |
| password | required, min:8, confirmed, mixed case + number + symbol |
| name | required, string, max:255 |
| graduation_year | nullable, integer, between:1950 and current year |
| roles | required, array, each must exist in roles table, valid combination |
| event_date | required, date, after:now |
| capacity | nullable, integer, min:1 |
| message body | required, string, min:1, max:5000 |
| goal progress | integer, between:0 and 100 |

### 7.4 Error Handling Strategy
| HTTP Code | Usage |
|-----------|-------|
| 200 | Successful GET/PATCH |
| 201 | Successful POST (resource created) |
| 204 | Successful DELETE |
| 401 | Unauthenticated |
| 403 | Forbidden (wrong role/permission) |
| 404 | Resource not found |
| 422 | Validation error (with field-level errors) |
| 429 | Rate limit exceeded |
| 500 | Server error (logged, generic user message) |

All error responses follow format:
```json
{
  "message": "Human-readable error description",
  "errors": { "field": ["Specific validation message"] }
}
```

---

## 8. Deployment & Setup (XAMPP)

### 8.1 Prerequisites
- XAMPP with PHP 8.2+ and MySQL 8.0+
- Composer 2.x
- Node.js 18+ (for frontend assets)

### 8.2 Setup Steps
1. Clone repo into `htdocs/alumni-connect`
2. `composer install`
3. Copy `.env.example` → `.env`, configure DB credentials
4. `php artisan key:generate`
5. Create MySQL database `alumni_connect`
6. `php artisan migrate`
7. `php artisan db:seed` (seeds all roles + sample users for every role combo)
8. `npm install && npm run build`
9. `php artisan serve`

### 8.3 Seed Data
| User | Roles | Email | Password |
|------|-------|-------|----------|
| Admin User | admin | admin@alumni.test | password |
| Alumni User | alumni | alumni@alumni.test | password |
| Student User | student | student@alumni.test | password |
| Mentor User | mentor | mentor@alumni.test | password |
| Organizer User | organizer | organizer@alumni.test | password |
| Alumni Mentor | alumni, mentor | alumnimentor@alumni.test | password |
| Alumni Organizer | alumni, organizer | alumniorg@alumni.test | password |

### 8.4 Pre-Launch Checklist
- [ ] APP_DEBUG=false in production
- [ ] APP_ENV=production
- [ ] Unique APP_KEY generated
- [ ] Database credentials secured
- [ ] CSRF protection active
- [ ] Rate limiting configured
- [ ] Mail driver configured for notifications
- [ ] Storage symlinked (`php artisan storage:link`)
- [ ] Caches cleared and rebuilt (`php artisan optimize`)
- [ ] All migrations run; seeders tested
- [ ] Admin account password changed from default

---

## 9. Test Scenarios & User Workflows

### 9.1 Single-Role Workflows

**Student Workflow:**
1. Register as student → verify limited dashboard
2. Search directory → confirm limited field visibility
3. Browse mentors → send request → verify limit enforcement
4. RSVP to event → confirm in registrations
5. Message mentor → confirm non-mentor messaging blocked

**Alumni Workflow:**
1. Register as alumni → verify full dashboard
2. Edit profile with work history → confirm in directory
3. Post to feed → verify visibility rules
4. Message any user → confirm no restrictions
5. Request mentorship → verify no limit

**Admin Workflow:**
1. Login → verify admin dashboard access
2. Search users → assign role → verify combination validation
3. Disable user → verify login blocked
4. View analytics → confirm data accuracy
5. Resolve flagged content → verify notification

### 9.2 Multi-Role Workflows

**Alumni + Mentor:**
1. Login → see combined dashboard (alumni + mentor sections)
2. Message any user (alumni perm) + manage mentees (mentor perm)
3. Create event → should fail (neither role permits it)

**Alumni + Organizer:**
1. Login → see alumni dashboard + event management
2. Create event + RSVP to others' events
3. Track attendance on own events
4. Post event announcements to feed (alumni perm)

### 9.3 Edge Case Test Scenarios
- Register with `student + mentor` → expect rejection
- Student sends message to random alumni → expect `403`
- RSVP to event at capacity → expect waitlist or `422`
- Two users RSVP simultaneously to last spot → verify one succeeds
- Admin disables self → expect `403`
- Mentor declines request, mentee re-requests within 30 days → expect cooldown error
- Delete event with 50 RSVPs → require confirmation, verify all notified
