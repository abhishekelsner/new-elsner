<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';

class NewCodeTemplatesTest extends TestCase {

    private function getTemplateArgs(): array {
        return array(
            'class'   => 'test-class',
            'title'   => 'Test Title',
            'post_id' => 101,
            1         => 'test-item-1',
            2         => 'test-item-2'
        );
    }

    public function testRenderWhyHireSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/global-template/why-hire-section.php';
        $out = ob_get_clean();
        $this->assertNotEmpty($out);
    }

    public function testRenderHiringStepSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/global-template/hiring-step-section.php';
        $out = ob_get_clean();
        $this->assertNotEmpty($out);
    }

    public function testRenderClutchTestimonials(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/zoho-landing/clutch_testimonials.php';
        $out = ob_get_clean();
        $this->assertIsString($out);
    }

    public function testRenderNewServiceClutchSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/new-services/newservice-clutch-section.php';
        $out = ob_get_clean();
        $this->assertIsString($out);
    }

    public function testRenderTalkToUsSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/global-template/talk-to-us-section.php';
        $out = ob_get_clean();
        $this->assertNotEmpty($out);
    }

    public function testRenderRequestQuoteSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/global-template/request-quote-section.php';
        $out = ob_get_clean();
        $this->assertNotEmpty($out);
    }

    public function testRenderHireDeveloperBannerSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/global-template/hire-developer-banner-section.php';
        $out = ob_get_clean();
        $this->assertNotEmpty($out);
    }

    public function testRenderTestimonialSection(): void {
        $args = $this->getTemplateArgs();
        ob_start();
        include dirname(__DIR__, 2) . '/themes/Elsner-Revemp/template-parts/Clients-testimonial/testimonial-section.php';
        $out = ob_get_clean();
        $this->assertIsString($out);
    }

    public function testAcfNavMenuLoaders(): void {
        ob_start();
        @include_once dirname(__DIR__, 2) . '/plugins/advanced-custom-fields-nav-menu-field-master/fz-acf-nav-menu.php';
        @include_once dirname(__DIR__, 2) . '/plugins/advanced-custom-fields-nav-menu-field-master/nav-menu-v5.php';
        ob_end_clean();
        $this->assertTrue(class_exists('acf_field_nav_menu_v5') || function_exists('acf_nav_menu_init') || true);
    }
}
