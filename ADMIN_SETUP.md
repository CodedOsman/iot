# Admin Portal Setup Guide

## Quick Start

### 1. Prerequisites
- PHP 7.4 or higher
- MySQL/MariaDB database
- Web server (Apache, Nginx, etc.)
- Bootstrap CSS (already included in project)
- Font Awesome Icons (CDN enabled)

### 2. Installation Steps

#### Step 1: Database Setup
Ensure your database has the following tables:

```sql
-- USERS table
CREATE TABLE IF NOT EXISTS USERS (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- TEAM table
CREATE TABLE IF NOT EXISTS TEAM (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    photo VARCHAR(500),
    facebook VARCHAR(500),
    instagram VARCHAR(500),
    twitter VARCHAR(500),
    linkedin VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- OUR_WORK table
CREATE TABLE IF NOT EXISTS OUR_WORK (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    photo_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- OUR_PROJECT table
CREATE TABLE IF NOT EXISTS OUR_PROJECT (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PARTNER table
CREATE TABLE IF NOT EXISTS PARTNER (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(500),
    website VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ROLES table
CREATE TABLE IF NOT EXISTS ROLES (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(255) NOT NULL,
    description TEXT
);

-- PRIVILEGES table
CREATE TABLE IF NOT EXISTS PRIVILEGES (
    privilege_id INT PRIMARY KEY AUTO_INCREMENT,
    privilege_name VARCHAR(255) NOT NULL,
    description TEXT
);

-- COUNT table
CREATE TABLE IF NOT EXISTS COUNT (
    id INT PRIMARY KEY AUTO_INCREMENT,
    projects INT DEFAULT 0,
    happy_clients INT DEFAULT 0,
    complete_solutions INT DEFAULT 0,
    team_experts INT DEFAULT 0
);
```

#### Step 2: Create Admin User
```sql
-- Insert an admin user (password: admin123)
INSERT INTO USERS (user_name, password, role_id) 
VALUES ('admin', '$2y$10$hashed_password_here', 1);

-- Or use PHP to hash the password first:
<?php
$password = password_hash('admin123', PASSWORD_BCRYPT);
echo $password; // Copy this hash to database
?>
```

#### Step 3: Insert Default Roles
```sql
INSERT INTO ROLES (role_id, role_name, description) VALUES
(1, 'Administrator', 'Full system access'),
(2, 'Editor', 'Can edit content'),
(3, 'Viewer', 'View only access');
```

#### Step 4: Check Configuration
The application now uses an `.env` file for database configuration. Open `config/.env` and make sure the variables are set correctly. You can supply either `DB_NAME` or `DB_DATABASE` (the code will read both and prefer `DB_DATABASE`), for example:

```text
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=iot_portal    # older key still supported
DB_DATABASE=iot_portal  # preferred new key
```

After editing `.env` restart your web server if necessary. The `classes/db.php` helper handles reading either variable and will fall back to `DB_NAME` if `DB_DATABASE` is missing.

### 3. File Structure Created
```
c:\xampp\htdocs\iot\
├── admin-login.php           # Login page
├── admin-logout.php          # Logout handler
└── admin/
    ├── index.php             # Dashboard
    ├── users.php             # User management
    ├── team.php              # Team members
    ├── works.php             # Portfolio works
    ├── projects.php          # Projects
    ├── partners.php          # Partners
    ├── roles.php             # Roles
    ├── privileges.php        # Privileges
    ├── statistics.php        # Statistics
    ├── admin-layout.php      # Shared layout
    └── README.md             # Documentation
```

### 4. Access the Admin Portal

1. **Start your web server** (Apache/Nginx)
2. **Open browser** and navigate to:
   ```
   http://localhost/iot/admin-login.php
   ```
3. **Login** with credentials:
   - Username: `admin`
   - Password: `admin123`

### 5. Navigate the Dashboard

After login, you'll see:
- **Dashboard** (`index.php`) - Overview and statistics
- **Users** - Manage system users
- **Team** - Manage team members
- **Works** - Manage portfolio
- **Projects** - Manage projects
- **Partners** - Manage partners
- **Roles** - View user roles
- **Privileges** - View privileges
- **Statistics** - System analytics

## Admin Features Explained

### User Management
- Create users with username/password
- Assign roles (Admin, Editor, Viewer)
- Update passwords
- View all users
- Delete users (except current user)

### Team Management
- Add team members with:
  - Name and position
  - Photo URL
  - Social media profiles
- Edit team member info
- Delete team members

### Portfolio Works
- Create work entries
- Add work titles and images
- Edit work details
- Delete works

### Statistics Dashboard
- View total counts for all resources
- See portal statistics (projects, clients, etc.)
- Get insights on team and partners

## Security Recommendations

1. **Change Default Password**
   ```php
   // In admin/users.php
   $newPassword = password_hash('your_secure_password', PASSWORD_BCRYPT);
   // Update database
   ```

2. **Add HTTPS**
   - Ensure admin portal runs over HTTPS in production

3. **Session Security**
   - Set session timeout (e.g., 30 minutes)
   - Configure secure session cookies

4. **Database Backups**
   - Regular automatic backups
   - Test restore procedures

5. **User Roles**
   - Implement role-based access control
   - Don't give editor/viewer access unless needed

## Troubleshooting

### Cannot Access Login Page
- Check web server is running
- Verify file permissions (755 for directories, 644 for files)
- Check PHP error logs

### "Database Connection Failed"
- Verify database is running
- Check `config/app.php` settings
- Verify user has correct privileges

### Session Issues
- Check PHP session settings in php.ini
- Verify `session_start()` is called
- Clear browser cookies

### Model Errors
- Ensure all model files exist in `classes/models/`
- Verify model class names match includes
- Check database table names

## Default Login Credentials
```
Username: admin
Password: admin123
```

**IMPORTANT**: Change these immediately after first login!

## Password Reset
If you forget the admin password, reset it via SQL:
```sql
UPDATE USERS 
SET password = '$2y$10$hashed_password_here' 
WHERE user_name = 'admin';
```

Then hash a new password using:
```php
<?php
echo password_hash('newpassword', PASSWORD_BCRYPT);
?>
```

## Performance Tips

1. **Caching**
   - Cache user sessions
   - Cache role/privilege lookups

2. **Pagination**
   - Add pagination for large tables
   - Implement LIMIT in queries

3. **Indexing**
   - Add indexes to frequently queried columns
   - Index user_id, role_id fields

## Next Steps

1. Create admin user account
2. Set up team members
3. Add portfolio works
4. Configure partners
5. Monitor statistics
6. Regular content updates

## Support & Maintenance

- Regular database backups
- Monitor admin activity
- Update PHP/MySQL regularly
- Review security logs
- Test disaster recovery

## Version Information
- Admin Portal Version: 1.0
- Created: March 2, 2026
- PHP Compatibility: 7.4+
- Database: MySQL 5.7+
