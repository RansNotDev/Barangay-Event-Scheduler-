# Barangay Event Scheduler System

## Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Installation Guide](#installation-guide)
5. [Usage](#usage)
6. [Folder Structure](#folder-structure)
7. [API Endpoints](#api-endpoints)
8. [Contributing](#contributing)
9. [License](#license)

---

## Introduction
The **Barangay Event Scheduler System** is a web-based application designed to manage and schedule events within a barangay. It allows users to create, view, update, delete, and cancel events while keeping a detailed record of past and canceled events.

---

## Features
- **User Management**
  - Admin authentication.
  - Role-based access control.
- **Event Scheduling**
  - Add, update, and delete events.
  - Set event details like location, room, and time.
- **Canceled Events**
  - Log canceled events for historical tracking.
  - View and manage canceled events.
- **Conflict Detection**
  - Prevent overlapping schedules.
- **Responsive Design**
  - Accessible on desktop and mobile devices.
- **Database Backup**
  - Export and manage system data for backups.

---

## Technologies Used
- **Frontend**: HTML, CSS (Bootstrap), JavaScript (jQuery, AJAX)
- **Backend**: PHP (Object-Oriented Programming)
- **Database**: MySQL
- **Framework/Library**: None (Custom PHP)
- **Other Tools**: VS Code, XAMPP/WAMP for local development

---

## Installation Guide

1. **Pre-requisites**
   - Install [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/).
   - Ensure PHP (>= 7.4) and MySQL are installed.

2. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/barangay-event-scheduler.git
   cd barangay-event-scheduler
Database Setup

Open PHPMyAdmin (http://localhost/phpmyadmin).
Create a new database, e.g., barangay_scheduler.
Import the provided barangay_scheduler.sql file located in the /db folder.
Configure the Project

Update database credentials in config.php:
php
Copy code
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'barangay_scheduler');
Start Local Server

Place the project folder in the htdocs directory (XAMPP) or equivalent.
Start Apache and MySQL services in XAMPP/WAMP.
Access the system at http://localhost/barangay-event-scheduler.
Usage
Admin Functions
Log in with admin credentials.
Navigate to the dashboard to:
Add new schedules.
View existing schedules.
Manage canceled events.
Update event details or delete them.
User Functions
View events for a specific day or range.
Search for events by name, date, or location.
Request for room availability or scheduling.
Folder Structure
bash
Copy code
barangay-event-scheduler/
│
├── db/
│   └── barangay_scheduler.sql   # Database schema and sample data
├── classes/
│   └── Master.php               # Core backend logic
├── config.php                   # Database configuration
├── index.php                    # Landing page
├── assets/
│   ├── css/                     # Custom styles
│   ├── js/                      # Custom scripts
│   └── images/                  # Application images
├── schedules/
│   ├── add_schedule.php         # Add event form
│   ├── edit_schedule.php        # Edit event form
│   └── list_schedules.php       # List of all events
├── canceled/
│   └── list_canceled.php        # List of canceled events
└── README.md                    # Project documentation
API Endpoints
Master.php (Main Actions)
Save Schedule

URL: classes/Master.php?f=save_schedule
Method: POST
Payload:
json
Copy code
{
  "room_name": "Main Hall",
  "datetime_start": "2024-12-05 09:00:00",
  "datetime_end": "2024-12-05 11:00:00",
  "reserved_by": "John Doe"
}
Delete Schedule

URL: classes/Master.php?f=delete_sched
Method: POST
Payload:
json
Copy code
{
  "id": 123
}
Fetch Canceled Events

URL: classes/Master.php?f=get_canceled_events
Method: GET
Contributing
Fork the repository.
Create a new branch for your feature/bugfix.
Submit a pull request with a clear description of your changes.
License
This project is licensed under the MIT License.
