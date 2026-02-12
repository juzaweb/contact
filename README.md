# Juzaweb Contact Module

A powerful and flexible Contact Module for Juzaweb CMS. This module allows you to easily add a contact form to your website and manage contact submissions from the admin panel.

## Features

- **Public Contact Form**: A customizable contact form for users to submit inquiries.
- **Admin Management**: An intuitive interface to view, manage, and respond to contact requests.
- **Email Notifications**: Automatically sends confirmation emails to users upon submission.
- **Data Validation**: Ensures all submissions contain valid and required information.
- **Multilingual Support**: Supports multiple languages including English, Vietnamese, and many others.
- **Customizable**: Publish configuration and views to tailor the module to your specific needs.

## Installation

You can install the package via composer:

```bash
composer require juzaweb/contact
```

After installation, the module will be automatically registered. Juzaweb CMS handles the migrations automatically.

## Usage

### Frontend Form

To use the contact form, create a form on your frontend that submits a POST request to the `/contact` route.

**Example HTML Form:**

```html
<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send Message</button>
</form>
```

**Required Fields:**
- `name` (string, max 200)
- `email` (email)
- `subject` (string, max 200)
- `message` (text)

**Optional Fields:**
- `phone` (string, max 20)

### Backend Management

Access the contact submissions via the Juzaweb Admin Panel. Navigate to **Contacts** in the sidebar menu. Here you can:
- View a list of all contact submissions.
- Edit contact details.
- Update the status of a contact request.
- Delete unwanted submissions.

## Customization

You can publish the module's configuration and views to customize them according to your requirements.

### Publish Configuration

```bash
php artisan vendor:publish --tag=contact-config
```

This will publish the configuration file to `config/contact.php`.

### Publish Views

```bash
php artisan vendor:publish --tag=contact-module-views
```

This will publish the views to `resources/views/vendor/contact`. You can then modify the email templates and admin views.

## Testing

To run the tests for this module, use the following command:

```bash
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License.
