# Alumni Connect — Backend Schema Document

**Version:** 1.0 | **Date:** 2026-05-18 | **Database:** MySQL 8.0 | **ORM:** Eloquent

---

## 1. Entity-Relationship Model

```
                        ┌──────────┐
                        │  roles   │
                        └────┬─────┘
                             │ M:M via role_assignments
                        ┌────▼─────┐
          ┌─────────────┤  users   ├─────────────────┐
          │  1:1        └────┬─────┘ 1:M             │ 1:M
     ┌────▼─────┐            │              ┌────────▼────────┐
     │ profiles │     ┌──────┼──────┐       │ activity_posts  │
     └──────────┘     │      │      │       └─────────────────┘
                      │      │      │
              1:M     │  1:M │      │ 1:M
         ┌────▼───┐   │  ┌───▼────┐ │
         │messages │   │  │events  │ │
         │(sender) │   │  └───┬────┘ │
         │(receiver│   │      │      │
         └────────┘   │   1:M│      │
                      │  ┌───▼─────────┐
               ┌──────▼──┤event_       │
               │mentorships│registrations│
               └──┬───────┤             │
                  │       └─────────────┘
               1:M│
          ┌───────▼──────┐
          │mentorship_   │
          │goals         │
          └──────────────┘

Additional tables:
  event_attendances (event_id, user_id)
  flagged_contents  (polymorphic: post/message/event)
  audit_logs        (tracks all critical changes)
```

---

## 2. Complete Table Specifications

### 2.1 `roles`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | |
| name | VARCHAR(50) | UNIQUE, NOT NULL | student, alumni, mentor, organizer, admin |
| display_name | VARCHAR(100) | NOT NULL | Human-readable label |
| description | TEXT | NULLABLE | Role description |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |

### 2.2 `users`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | |
| name | VARCHAR(255) | NOT NULL | Full name |
| email | VARCHAR(255) | UNIQUE, NOT NULL, INDEX | Login identifier |
| email_verified_at | TIMESTAMP | NULLABLE | Verification timestamp |
| password | VARCHAR(255) | NOT NULL | bcrypt hashed |
| is_active | BOOLEAN | DEFAULT true | Account status |
| remember_token | VARCHAR(100) | NULLABLE | Session persistence |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |

### 2.3 `role_assignments`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| user_id | BIGINT UNSIGNED | FK→users, INDEX, CASCADE DELETE | |
| role_id | BIGINT UNSIGNED | FK→roles, CASCADE DELETE | |
| assigned_by | BIGINT UNSIGNED | FK→users, NULLABLE, NULL ON DELETE | Admin who assigned |
| assigned_at | TIMESTAMP | DEFAULT CURRENT | |
| | | UNIQUE(user_id, role_id) | Prevents duplicate assignments |

### 2.4 `profiles`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| user_id | BIGINT UNSIGNED | FK→users, UNIQUE, CASCADE DELETE | One profile per user |
| graduation_year | YEAR | NULLABLE, INDEX | Filtering |
| degree | VARCHAR(100) | NULLABLE | e.g., B.Tech, MBA |
| field_of_study | VARCHAR(255) | NULLABLE, INDEX | Major/department |
| bio | TEXT | NULLABLE | Personal description |
| location | VARCHAR(255) | NULLABLE, INDEX | Current city/country |
| phone | VARCHAR(20) | NULLABLE | Contact number |
| linkedin_url | VARCHAR(255) | NULLABLE | LinkedIn profile |
| company | VARCHAR(255) | NULLABLE | Current employer |
| job_title | VARCHAR(255) | NULLABLE | Current position |
| work_history | JSON | NULLABLE | `[{company, title, start, end}]` |
| skills | JSON | NULLABLE | `["PHP", "Laravel", "MySQL"]` |
| mentor_availability | BOOLEAN | DEFAULT false | Accepting mentees? |
| mentor_capacity | TINYINT UNSIGNED | DEFAULT 5 | Max active mentees |
| mentor_industries | JSON | NULLABLE | `["Tech", "Finance"]` |
| career_stage | VARCHAR(50) | NULLABLE | early, mid, senior, executive |
| avatar_path | VARCHAR(255) | NULLABLE | Profile photo path |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |

### 2.5 `messages`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| sender_id | BIGINT UNSIGNED | FK→users, INDEX, CASCADE DELETE | |
| receiver_id | BIGINT UNSIGNED | FK→users, INDEX, CASCADE DELETE | |
| body | TEXT | NOT NULL | Message content |
| read_at | TIMESTAMP | NULLABLE | NULL = unread |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |
| | | INDEX(sender_id, receiver_id) | Thread lookup |
| | | INDEX(receiver_id, read_at) | Unread queries |

### 2.6 `mentorships`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| mentor_id | BIGINT UNSIGNED | FK→users, INDEX, CASCADE DELETE | |
| mentee_id | BIGINT UNSIGNED | FK→users, INDEX, CASCADE DELETE | |
| status | ENUM | pending, active, declined, completed, terminated | DEFAULT 'pending' |
| request_message | TEXT | NULLABLE | Initial request note |
| responded_at | TIMESTAMP | NULLABLE | Accept/decline time |
| ended_at | TIMESTAMP | NULLABLE | Completion/termination |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |
| | | INDEX(status) | Dashboard queries |

### 2.7 `mentorship_goals`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| mentorship_id | BIGINT UNSIGNED | FK→mentorships, CASCADE DELETE | |
| title | VARCHAR(255) | NOT NULL | Goal title |
| description | TEXT | NULLABLE | Detailed description |
| progress | TINYINT UNSIGNED | DEFAULT 0, CHECK 0-100 | Completion percentage |
| completed_at | TIMESTAMP | NULLABLE | Auto-set when progress=100 |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |

### 2.8 `mentorship_interactions`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| mentorship_id | BIGINT UNSIGNED | FK→mentorships, CASCADE DELETE | |
| user_id | BIGINT UNSIGNED | FK→users, CASCADE DELETE | Who logged it |
| type | ENUM | note, meeting, milestone, feedback | Interaction category |
| content | TEXT | NOT NULL | Log details |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |

### 2.9 `events`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| organizer_id | BIGINT UNSIGNED | FK→users, CASCADE DELETE | Creator |
| title | VARCHAR(255) | NOT NULL | Event name |
| description | TEXT | NULLABLE | Details |
| category | VARCHAR(100) | NULLABLE, INDEX | reunion, webinar, networking, career_talk |
| location | VARCHAR(255) | NULLABLE | Venue or URL |
| event_date | DATETIME | NOT NULL, INDEX | Start date/time |
| end_date | DATETIME | NULLABLE | End date/time |
| capacity | INT UNSIGNED | NULLABLE | NULL = unlimited |
| status | ENUM | active, cancelled, completed | DEFAULT 'active', INDEX |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |

### 2.10 `event_registrations`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| event_id | BIGINT UNSIGNED | FK→events, CASCADE DELETE | |
| user_id | BIGINT UNSIGNED | FK→users, CASCADE DELETE | |
| status | ENUM | registered, waitlisted, cancelled | DEFAULT 'registered' |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| | | UNIQUE(event_id, user_id) | One RSVP per user per event |

### 2.11 `event_attendances`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| event_id | BIGINT UNSIGNED | FK→events, CASCADE DELETE | |
| user_id | BIGINT UNSIGNED | FK→users, CASCADE DELETE | |
| checked_in_at | TIMESTAMP | DEFAULT CURRENT | |
| | | UNIQUE(event_id, user_id) | One check-in per user |

### 2.12 `activity_posts`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| user_id | BIGINT UNSIGNED | FK→users, CASCADE DELETE | Author |
| content | TEXT | NOT NULL | Post body |
| visibility | ENUM | all, alumni_only, mentors_only | DEFAULT 'all' |
| is_flagged | BOOLEAN | DEFAULT false | Moderation flag |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| deleted_at | TIMESTAMP | NULLABLE | **Soft delete** |

### 2.13 `flagged_contents`
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| content_type | VARCHAR(50) | NOT NULL | post, message, event |
| content_id | BIGINT UNSIGNED | NOT NULL | Polymorphic ID |
| reported_by | BIGINT UNSIGNED | FK→users, CASCADE DELETE | Reporter |
| reason | TEXT | NOT NULL | Report reason |
| status | ENUM | pending, resolved, dismissed | DEFAULT 'pending', INDEX |
| resolved_by | BIGINT UNSIGNED | FK→users, NULLABLE, NULL ON DELETE | Admin who resolved |
| resolved_at | TIMESTAMP | NULLABLE | |
| created_at | TIMESTAMP | | |
| updated_at | TIMESTAMP | | |
| | | INDEX(content_type, content_id) | Polymorphic lookup |

### 2.14 `audit_logs` (Audit Trail)
| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | BIGINT UNSIGNED | PK | |
| user_id | BIGINT UNSIGNED | FK→users, NULLABLE, NULL ON DELETE | Actor |
| action | VARCHAR(50) | NOT NULL, INDEX | login, role_change, user_disabled, etc. |
| auditable_type | VARCHAR(100) | NULLABLE | Model class (polymorphic) |
| auditable_id | BIGINT UNSIGNED | NULLABLE | Model ID |
| old_values | JSON | NULLABLE | Previous state |
| new_values | JSON | NULLABLE | New state |
| ip_address | VARCHAR(45) | NULLABLE | Actor IP |
| user_agent | VARCHAR(255) | NULLABLE | Browser info |
| created_at | TIMESTAMP | | |
| | | INDEX(auditable_type, auditable_id) | |
| | | INDEX(user_id, action) | |

**Audit Trail Strategy:** Log all login/logout, role assignments/revocations, account enable/disable, mentorship status changes, event cancellations, and content moderation actions. Retention: 12 months. Never soft-delete audit logs.

---

## 3. Eloquent Model Definitions

### 3.1 User Model
```php
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'is_active'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'is_active' => 'boolean'];

    // Relationships
    public function roles()              { return $this->belongsToMany(Role::class, 'role_assignments')->withPivot('assigned_at', 'assigned_by'); }
    public function profile()            { return $this->hasOne(Profile::class); }
    public function sentMessages()       { return $this->hasMany(Message::class, 'sender_id'); }
    public function receivedMessages()   { return $this->hasMany(Message::class, 'receiver_id'); }
    public function mentorships()        { return $this->hasMany(Mentorship::class, 'mentor_id'); }
    public function menteeships()        { return $this->hasMany(Mentorship::class, 'mentee_id'); }
    public function organizedEvents()    { return $this->hasMany(Event::class, 'organizer_id'); }
    public function eventRegistrations() { return $this->hasMany(EventRegistration::class); }
    public function activityPosts()      { return $this->hasMany(ActivityPost::class); }
    public function auditLogs()          { return $this->hasMany(AuditLog::class); }

    // Has-Many-Through: events user is registered for
    public function registeredEvents()   { return $this->hasManyThrough(Event::class, EventRegistration::class, 'user_id', 'id', 'id', 'event_id'); }

    // Role helpers
    public function hasRole(string $role): bool     { return $this->roles->contains('name', $role); }
    public function hasAnyRole(array $roles): bool   { return $this->roles->whereIn('name', $roles)->isNotEmpty(); }
    public function primaryRole(): string            { return $this->roles->first()?->name ?? 'alumni'; }
}
```

### 3.2 Profile Model
```php
class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'graduation_year', 'degree', 'field_of_study', 'bio',
        'location', 'phone', 'linkedin_url', 'company', 'job_title',
        'work_history', 'skills', 'mentor_availability', 'mentor_capacity',
        'mentor_industries', 'career_stage', 'avatar_path',
    ];
    protected $casts = [
        'work_history' => 'array', 'skills' => 'array',
        'mentor_industries' => 'array', 'mentor_availability' => 'boolean',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
```

### 3.3 Mentorship Model
```php
class Mentorship extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['mentor_id', 'mentee_id', 'status', 'request_message', 'responded_at', 'ended_at'];
    protected $casts = ['responded_at' => 'datetime', 'ended_at' => 'datetime'];

    public function mentor()       { return $this->belongsTo(User::class, 'mentor_id'); }
    public function mentee()       { return $this->belongsTo(User::class, 'mentee_id'); }
    public function goals()        { return $this->hasMany(MentorshipGoal::class); }
    public function interactions() { return $this->hasMany(MentorshipInteraction::class); }

    public function scopeActive($q)  { return $q->where('status', 'active'); }
    public function scopePending($q) { return $q->where('status', 'pending'); }
}
```

### 3.4 Event Model
```php
class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['organizer_id','title','description','category','location','event_date','end_date','capacity','status'];
    protected $casts = ['event_date' => 'datetime', 'end_date' => 'datetime'];

    public function organizer()     { return $this->belongsTo(User::class, 'organizer_id'); }
    public function registrations() { return $this->hasMany(EventRegistration::class); }
    public function attendances()   { return $this->hasMany(EventAttendance::class); }

    // Many-to-many: registered users
    public function registeredUsers() { return $this->belongsToMany(User::class, 'event_registrations')->withPivot('status')->withTimestamps(); }

    public function isFull(): bool { return $this->capacity && $this->registrations()->where('status', 'registered')->count() >= $this->capacity; }
    public function spotsLeft(): ?int { return $this->capacity ? max(0, $this->capacity - $this->registrations()->where('status','registered')->count()) : null; }
}
```

### 3.5 Message Model
```php
class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sender_id', 'receiver_id', 'body', 'read_at'];
    protected $casts = ['read_at' => 'datetime'];

    public function sender()   { return $this->belongsTo(User::class, 'sender_id'); }
    public function receiver() { return $this->belongsTo(User::class, 'receiver_id'); }

    public function scopeUnread($q)    { return $q->whereNull('read_at'); }
    public function scopeBetween($q, $a, $b) {
        return $q->where(fn($q) => $q->where('sender_id',$a)->where('receiver_id',$b))
                 ->orWhere(fn($q) => $q->where('sender_id',$b)->where('receiver_id',$a));
    }
}
```

### 3.6 AuditLog Model
```php
class AuditLog extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','action','auditable_type','auditable_id','old_values','new_values','ip_address','user_agent','created_at'];
    protected $casts = ['old_values' => 'array', 'new_values' => 'array', 'created_at' => 'datetime'];

    public function user()      { return $this->belongsTo(User::class); }
    public function auditable() { return $this->morphTo(); }

    public static function record(string $action, ?Model $model = null, array $old = [], array $new = []): self {
        return self::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $model ? get_class($model) : null,
            'auditable_id' => $model?->id,
            'old_values' => $old ?: null,
            'new_values' => $new ?: null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }
}
```

---

## 4. Seeder Specification

### 4.1 RoleSeeder
Seeds 5 roles: student, alumni, mentor, organizer, admin.

### 4.2 SampleDataSeeder — Data Matrix

| Category | Count | Details |
|----------|-------|---------|
| **Users** | 27 total | 7 named test accounts + 20 random alumni |
| **Test Accounts** | 7 | admin, alumni, student, mentor, organizer, alumni+mentor, alumni+organizer |
| **Profiles** | 27 | All users get profiles with realistic data |
| **Events** | 6 | Across categories: reunion, webinar, networking, career_talk |
| **Event Registrations** | ~30 | Random users registered to events |
| **Mentorships** | 5 | 3 active, 1 pending, 1 completed |
| **Mentorship Goals** | 10 | 2 per active mentorship |
| **Mentorship Interactions** | 8 | Notes and meeting logs |
| **Messages** | 50+ | Across 4 conversation threads |
| **Activity Posts** | 15 | Various visibility levels |
| **Audit Logs** | 10+ | Login and role assignment records |

### 4.3 Test Account Credentials

| Email | Password | Roles |
|-------|----------|-------|
| admin@alumni.test | password | admin |
| alumni@alumni.test | password | alumni |
| student@alumni.test | password | student |
| mentor@alumni.test | password | mentor |
| organizer@alumni.test | password | organizer |
| alumnimentor@alumni.test | password | alumni, mentor |
| alumniorg@alumni.test | password | alumni, organizer |

---

## 5. Index Strategy

| Table | Indexed Columns | Purpose |
|-------|----------------|---------|
| users | email (unique), deleted_at | Login, soft delete queries |
| profiles | graduation_year, field_of_study, location | Directory filtering |
| messages | (sender_id, receiver_id), (receiver_id, read_at) | Thread lookup, unread count |
| mentorships | mentor_id, mentee_id, status | Dashboard queries |
| events | event_date, category, status | Listing/filtering |
| event_registrations | (event_id, user_id) unique | Duplicate prevention |
| event_attendances | (event_id, user_id) unique | Duplicate prevention |
| activity_posts | visibility | Feed filtering |
| flagged_contents | (content_type, content_id), status | Moderation queue |
| audit_logs | (auditable_type, auditable_id), (user_id, action) | Audit queries |

---

## 6. Design Decisions

| Decision | Rationale |
|----------|-----------|
| **Separate `profiles` table** | Keeps `users` lean for auth queries; profile data loaded only when needed |
| **`role_assignments` pivot** | Enables stackable roles without JSON columns; queryable and indexable |
| **JSON for `work_history`, `skills`** | Semi-structured data that varies per user; avoids excessive normalization |
| **ENUM for status columns** | Database-level constraint enforcement; clear valid states |
| **Soft deletes on users, profiles, messages, events, mentorships** | Data preservation for audit; prevents orphaned references |
| **No soft delete on audit_logs** | Audit trail must be immutable |
| **Separate `mentorship_interactions`** | Decouples interaction logging from goals; supports multiple log types |
| **Polymorphic `flagged_contents`** | Single table handles flagging for posts, messages, and events |
| **`audit_logs` with old/new values** | Full change tracking without complex event sourcing |
| **Capacity check via transaction + lock** | Prevents RSVP race conditions at capacity boundary |
