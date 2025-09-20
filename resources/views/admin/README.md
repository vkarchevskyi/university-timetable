# Custom Admin Interface

This is a beautiful custom admin interface built with Blade templates to replace Filament. It provides full CRUD functionality for managing Exceptions, Lessons, and Teachers in the university schedule system.

## Features

- **Modern UI**: Built with Tailwind CSS and Alpine.js for a responsive, beautiful interface
- **Full CRUD Operations**: Create, Read, Update, Delete for all resources
- **Search & Filtering**: Search by course names and filter results
- **Sorting**: Click on column headers to sort data
- **Bulk Actions**: Select multiple items for bulk deletion
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Flash Messages**: Success and error notifications
- **Pagination**: Clean pagination with page numbers

## Resources Managed

### 1. Exceptions
- Manage schedule exceptions (date-specific changes)
- Fields: Course, Date, Lesson Order, Teacher
- Search by course name
- Sort by course, date, order, teacher, created date

### 2. Lessons
- Manage regular lesson schedules
- Fields: Course, Day of Week, Lesson Order, Numerator Week, Teacher
- Rich day display with emojis and Ukrainian labels
- Boolean indicator for numerator weeks
- Search by course name

### 3. Teachers
- Manage teacher information
- Fields: Full Name, Created Date, Updated Date
- Simple name-based search
- Clean profile display with avatars

## Getting Started

### Routes
The admin interface is available at `/admin` with the following routes:

- Dashboard: `/admin`
- Exceptions: `/admin/exceptions`
- Lessons: `/admin/lessons`
- Teachers: `/admin/teachers`

### Building Assets
To compile the CSS and JS assets:

```bash
npm run dev    # For development
npm run build  # For production
```

### Database Requirements
Make sure you have the following models and relationships set up:
- `Exception` model with `course` and `teacher` relationships
- `Lesson` model with `course` and `teacher` relationships
- `Teacher` model
- `Course` model
- Proper enum classes: `DayOfWeek`, `LessonOrder`

## UI Components

### Navigation
- Collapsible sidebar with main navigation
- Active state indicators
- Mobile-responsive hamburger menu

### Tables
- Sortable columns with visual indicators
- Bulk selection with "select all" functionality
- Action buttons (edit, delete) for each row
- Empty states with call-to-action buttons

### Forms
- Clean, accessible form layouts
- Validation error display
- Select dropdowns for relationships
- Date pickers and checkboxes
- Cancel and submit actions

### Dashboard
- Statistics cards showing totals for each resource
- Quick action buttons for creating new items
- Modern card layouts with icons

## Technical Stack

- **Backend**: Laravel with Blade templates
- **Frontend**: Tailwind CSS + Alpine.js
- **Icons**: Font Awesome 6
- **Build Tool**: Vite
- **Responsive**: Mobile-first design

## Customization

The admin interface is highly customizable:

1. **Styling**: Modify `resources/css/admin.css` for custom styles
2. **Layout**: Edit `resources/views/admin/layout.blade.php` for layout changes
3. **Colors**: Update Tailwind classes for different color schemes
4. **Components**: Add new Blade components in `resources/views/admin/components/`

## Security

- CSRF protection on all forms
- Route model binding for automatic 404s
- Bulk action confirmation dialogs
- Input validation on all forms

## Performance

- Efficient database queries with eager loading
- Pagination to handle large datasets
- Optimized CSS and JS builds
- Minimal external dependencies

This admin interface provides the same functionality as Filament but with complete control over the UI/UX and easier customization options.
