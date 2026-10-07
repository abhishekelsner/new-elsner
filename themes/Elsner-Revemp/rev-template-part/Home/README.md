# rev-template-part/Home - ACF Flexible Content Section Templates

This folder contains template files for rendering ACF Flexible Content sections. These are section templates that are used by page templates in the `Rev-Template/` directory.

## Structure

Each template file corresponds to a layout in the ACF Flexible Content field `home`:

- `hero-section.php` - Hero Section with title, subtitle, background image, and CTA button
- `client-logos.php` - Client logos display section
- `counter-section.php` - Statistics counter section with icons, numbers, and labels
- `our-expertise.php` - Services/Expertise cards section
- `cta-banner.php` - Call-to-action banner with customizable background color
- `why-choose-elsner.php` - Features section with icons and titles
- `success-stories.php` - Case studies showcase section
- `industries-served.php` - Industries grid with client logos
- `featured-in.php` - Media logos section
- `meet-our-experts.php` - Events/Expert showcase section
- `technology-partners.php` - Technology partner cards
- `testimonials.php` - Client testimonials section
- `flexible-content-loop.php` - Main loop file that renders all sections

## Usage

### Method 1: Using the Flexible Content Loop

Include the main loop file in your page template:

```php
<?php
get_template_part('rev-template-part/Home/flexible-content-loop', null, array('post_id' => get_the_ID()));
?>
```

### Method 2: Manual Loop

Loop through the flexible content manually in your page template:

```php
<?php
$post_id = get_the_ID();
if (have_rows('home', $post_id)) :
    while (have_rows('home', $post_id)) : the_row();
        $layout = get_row_layout();
        
        switch ($layout) {
            case 'hero_section':
                get_template_part('rev-template-part/Home/hero-section', null, array('post_id' => $post_id));
                break;
            case 'client_logos':
                get_template_part('rev-template-part/Home/client-logos', null, array('post_id' => $post_id));
                break;
            // ... add other cases as needed
        }
    endwhile;
endif;
?>
```

### Method 3: Include Individual Sections

Include specific sections directly:

```php
<?php
get_template_part('rev-template-part/Home/hero-section', null, array('post_id' => get_the_ID()));
?>
```

## Template Structure

Each template file:
- Accepts `$args['post_id']` to get the post ID
- Uses `get_sub_field()` to retrieve ACF field values
- Follows WordPress coding standards
- Includes proper escaping for output
- Uses semantic HTML structure

## Customization

You can customize each template file to match your design requirements:
- Modify HTML structure
- Add custom CSS classes
- Adjust Bootstrap grid columns
- Add additional conditional logic
- Include custom JavaScript functionality

## Notes

- All templates use `get_sub_field()` since they're called within a flexible content loop
- Image fields return arrays with `url`, `alt`, etc. when using `return_format => 'array'`
- Post object fields may return single objects or arrays depending on the `multiple` setting
- All output is properly escaped using WordPress functions (`esc_html()`, `esc_url()`, `esc_attr()`)

