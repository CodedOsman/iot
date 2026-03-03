# IoT Admin Portal Documentation

## Overview
This comprehensive admin portal provides full management of all IoT portal entities and features. The portal includes user authentication, dashboard, and management pages for all core resources.

## Features

### 1. **Authentication**
- **Login Page**: `admin-login.php`
- Secure session-based authentication
- Password hashing with bcrypt
- Session timeout protection

### 2. **Dashboard** (`admin/index.php`)
- Overview of all system statistics
- Quick access cards showing:
  - Total Users
  - Team Members
  - Our Works
  - Projects
  - Partners
- Quick action buttons for adding new resources

### 3. **User Management** (`admin/users.php`)
Features:
- List all users
- Create new users with username, password, and role assignment
- Edit existing users (change role, update password)
- Delete users (with confirmation, prevents deleting current user)
- View user details

Operations:
- Add users with bcrypt password hashing
- Assign/change user roles
- Reset user passwords
- Manage user access permissions

### 4. **Team Management** (`admin/team.php`)
Features:
- List all team members
- Create new team members with:
  - Name and position
  - Photo URL
  - Social media links (Facebook, Instagram, Twitter, LinkedIn)
- Edit team member details
- Delete team members

Fields:
- Name (required)
- Position (required)
- Photo URL
- Social Media Links (optional)

### 5. **Our Works** (`admin/works.php`)
Features:
- List all portfolio works
- Create new work entries with:
  - Title (required)
  - Photo URL
- Edit work details
- Delete works
- Image preview in list

### 6. **Projects Management** (`admin/projects.php`)
Features:
- View all projects
- Project listing with ID and title
- Delete projects
- Quick navigation

### 7. **Partners Management** (`admin/partners.php`)
Features:
- List all partners
- Add new partners
- Partner management
- Delete partners

### 8. **Roles Management** (`admin/roles.php`)
Features:
- View all system roles
- List role details
- Delete roles
- Role assignment reference

### 9. **Privileges Management** (`admin/privileges.php`)
Features:
- View all system privileges
- Privilege listing
- Delete privileges
- Permission management reference

### 10. **Statistics & Analytics** (`admin/statistics.php`)
Displays:
- Content overview cards:
  - Total users count
  - Team members count
  - Works count
  - Projects count
  - Partners count
- Portal statistics:
  - Projects count from counter
  - Happy clients
  - Complete solutions
  - Team experts
- Detailed breakdowns:
  - User statistics (total, admin count)
  - Team statistics (members, positions)
  - Works statistics (total, with photos)
  - Partners statistics (total, active)

## Directory Structure
```
admin/
├── index.php                 # Dashboard
├── users.php                # User management
├── team.php                 # Team members management
├── works.php                # Works/portfolio management
├── projects.php             # Projects management
├── partners.php             # Partners management
├── roles.php                # Roles management
├── privileges.php           # Privileges management
├── statistics.php           # Statistics and analytics
└── admin-layout.php         # Shared layout template

admin-login.php              # Login page
admin-logout.php             # Logout handler
```

## User Interface

### Common Features Across All Pages
- **Sidebar Navigation**: Quick access to all admin sections
- **Top Navbar**: Page title, current user info, logout button
- **Responsive Design**: Mobile-friendly layout
- **Color Scheme**: 
  - Primary: #667eea (purple)
  - Secondary: #764ba2 (darker purple)
  - Success: #48bb78 (green)
  - Danger: #f56565 (red)

### Standard CRUD Operations
All management pages support:
- **Create**: Add new entries
- **Read**: View all entries in table format
- **Update**: Edit existing entries
- **Delete**: Remove entries with confirmation

## Authentication Flow

1. User visits `/admin-login.php`
2. Enters username and password
3. System verifies credentials against `USERS` table
4. Password verified using `password_verify()` with bcrypt
5. Session created: `$_SESSION['admin_user_id']`, `$_SESSION['admin_username']`, `$_SESSION['admin_role_id']`
6. User redirected to dashboard
7. All admin pages check session before displaying content

## Security Features

- Session-based authentication
- Password hashing with bcrypt (PASSWORD_BCRYPT)
- SQL injection prevention (PDO prepared statements)
- XSS prevention (htmlspecialchars on output)
- CSRF protection (standard form submissions)
- Confirmation dialogs for delete operations
- Cannot delete current logged-in user

## Database Models Used

The admin portal integrates with these models:
- `User` - User management
- `Team` - Team members
- `OurWork` - Portfolio works
- `OurProject` - Projects
- `Partner` - Partners
- `Count` - Statistics counter
- `Role` - User roles
- `Privilege` - User privileges

## How to Access

1. **Login**: Navigate to `http://localhost/iot/admin-login.php`
2. **Default Credentials**: Set up admin user first via database
3. **Dashboard**: After login, redirected to `http://localhost/iot/admin/index.php`

## Navigation

From any admin page:
- Click logo/home in sidebar → Dashboard
- Click specific menu items → Jump to that section
- Click logout → Return to login page
- Top navbar shows current page and user info

## Best Practices

1. **Password Management**: Always use strong passwords
2. **Regular Backups**: Backup database regularly
3. **User Roles**: Assign appropriate roles to users
4. **Monitoring**: Check statistics regularly
5. **Content Updates**: Keep team, works, and partners info current

## Technical Requirements

- PHP 7.4+
- PDO Database Extension
- Session Support
- Bootstrap CSS Framework
- Font Awesome Icons

## Future Enhancements

- Permission-based access control
- Bulk operations (CSV import/export)
- Activity logging
- Advanced search filters
- Image upload with validation
- Email notifications
- API integration
- Two-factor authentication

## Support

For issues or questions:
1. Check session is active
2. Verify database connections
3. Review error logs
4. Ensure database tables exist with correct schema
