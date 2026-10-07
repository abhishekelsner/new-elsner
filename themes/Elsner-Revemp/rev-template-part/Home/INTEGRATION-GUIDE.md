# Integration Guide - How to Use rev-template-part/Home Sections

## Quick Start

### Option 1: Use the Pre-built Page Template (Easiest)

1. **Create or Edit a Page in WordPress Admin**
   - Go to Pages → Add New (or edit existing page)
   - In the Page Attributes box, select **"Home"** or **"Flexible Content Page"** as the template
   - Add your ACF Flexible Content sections using the "Home" field group
   - Publish the page

That's it! The page will automatically render all sections you add.

---

### Option 2: Add to Existing Page Template

If you want to use this in an existing page template, add this code where you want the flexible content to appear:

```php
<?php
// In your page template file (e.g., page.php, or custom template)
get_template_part('rev-template-part/Home/flexible-content-loop', null, array('post_id' => get_the_ID()));
?>
```

**Example - Adding to page.php:**

```php
<?php
get_header();
?>

<main id="main-content">
    <?php
    while (have_posts()) :
        the_post();
        
        // Render flexible content sections
        get_template_part('rev-template-part/Home/flexible-content-loop', null, array('post_id' => get_the_ID()));
        
    endwhile;
    ?>
</main>

<?php
get_footer();
?>
```

---

### Option 3: Use in a Custom Template (Like template-home-new.php)

If you want to replace the hardcoded sections in `template-home-new.php` with flexible content:

```php
<?php
/**
 * Template Name: Home New 
 */
get_header();
?>

<div id="fullpage">
    <?php
    // Replace all the individual get_template_part calls with:
    get_template_part('rev-template-part/Home/flexible-content-loop', null, array('post_id' => get_the_ID()));
    ?>
</div>

<?php
get_footer('home');
?>
```

---

## Step-by-Step: Setting Up Your First Page

1. **Go to WordPress Admin → Pages → Add New**

2. **Set the Page Template:**
   - In the right sidebar, find "Page Attributes"
   - Under "Template", select **"Home"** or **"Flexible Content Page"**

3. **Add ACF Flexible Content:**
   - Scroll down to find the "Home" field group
   - Click "Add Row" button
   - Select a layout (e.g., "Hero Section")
   - Fill in the fields (Title, Subtitle, Background Image, etc.)
   - Click "Add Row" again to add more sections
   - Arrange sections by dragging them up/down

4. **Publish the Page**

5. **View the Page** - All your sections will render automatically!

---

## Available Sections

When adding rows in the ACF Flexible Content field, you can choose from:

- **Hero Section** - Main banner with title, subtitle, background image, and CTA
- **Client Logo** - Display client logos in a grid
- **Counter Section** - Statistics with icons, numbers, and labels
- **Our Expertise** - Service cards with icons, titles, and descriptions
- **CTA Banner** - Call-to-action banner with customizable background
- **Why Choose Elsner** - Features section with icons
- **Success Stories** - Case studies showcase
- **Industries Served** - Industries grid with client logos
- **Featured In** - Media logos section
- **Meet Our Experts** - Events/expert showcase
- **Technology Partners** - Partner cards
- **Testimonials** - Client testimonials

---

## Customization

### Modify Individual Section Templates

Edit any file in `/rev-template-part/Home/` to customize:
- HTML structure
- CSS classes
- Bootstrap grid columns
- Additional functionality

### Add Custom Styling

Add CSS to your theme's stylesheet targeting the section classes:
- `.hero-section`
- `.client-logos-section`
- `.counter-section`
- etc.

---

## Troubleshooting

### Sections Not Showing?

1. **Check ACF Field Name:**
   - Make sure your ACF field group is named exactly `home`
   - Or update the field name in `flexible-content-loop.php` line 16

2. **Check Page Template:**
   - Ensure you selected "Flexible Content Page" template
   - Or added the `get_template_part()` call to your template

3. **Check ACF is Active:**
   - Verify Advanced Custom Fields plugin is installed and activated

### Template Not Found?

- Make sure section template files are in `/rev-template-part/Home/` folder
- Page templates (like `home.php`) should be in `/Rev-Template/` folder
- Check file names match exactly (case-sensitive)

---

## Directory Structure

- **`Rev-Template/`** - Contains page templates (e.g., `home.php`) that use template name
- **`rev-template-part/Home/`** - Contains section templates (e.g., `hero-section.php`, `flexible-content-loop.php`)

## Need Help?

- Check `README.md` in the rev-template-part/Home folder for detailed documentation
- Review the template files to understand the structure
- Each template file has comments explaining what it does

