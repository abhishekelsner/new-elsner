<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/elsner-shortcode.php';

class ElsnerShortcodeTest extends TestCase {

    public function testTestimonialShortcode(): void {
        ob_start();
        testimonial_shortcode();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('review-item', $output);
    }

    public function testPortfoliosShortcode(): void {
        ob_start();
        portfolios_shortcode(array());
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('gal-item', $output);
    }

    public function testPortfoliosliderShortcode(): void {
        ob_start();
        portfolioslider_shortcode(array('category' => 'ecommerce'));
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('service_desc', $output);
    }
}
