<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/other-functions.php';

class OtherFunctionsTest extends TestCase {

    public function testCustomFilterWpcf7IsTel(): void {
        $this->assertTrue(custom_filter_wpcf7_is_tel(false, '1234567890'));
        $this->assertTrue(custom_filter_wpcf7_is_tel(false, '+1 1234567890'));
        $this->assertTrue(custom_filter_wpcf7_is_tel(false, '(12) 1234567890'));
        $this->assertTrue(custom_filter_wpcf7_is_tel(false, '12-1234567890'));
        $this->assertFalse(custom_filter_wpcf7_is_tel(false, 'abcdefghij'));
        $this->assertFalse(custom_filter_wpcf7_is_tel(false, '123'));
    }

    public function testWebpUploadMimes(): void {
        $mimes = array('jpg' => 'image/jpeg', 'png' => 'image/png');
        $updated = webp_upload_mimes($mimes);
        $this->assertIsArray($updated);
        $this->assertEquals('image/webp', $updated['webp']);
    }

    public function testAddJsonToUploadMimes(): void {
        $mimes = array('jpg' => 'image/jpeg');
        $updated = add_json_to_upload_mimes($mimes);
        $this->assertIsArray($updated);
        $this->assertEquals('text/plain', $updated['json']);
        $this->assertEquals('image/x-icon', $updated['ico']);
    }

    public function testRegisterPortfolioTagsTaxonomy(): void {
        register_portfolio_tags_taxonomy();
        $this->assertTrue(true);
    }

    public function testAioseoFilterCanonicalUrl(): void {
        ob_start();
        aioseo_filter_canonical_url('https://example.com/canonical-test/');
        $output = ob_get_clean();
        $this->assertStringContainsString('<link rel="canonical" href="https://example.com/canonical-test/" />', $output);
    }

    public function testConditionalsDontloadAndRecaptcha(): void {
        dontload();
        recaptchaCheck();
        dm_remove_wp_block_library_css();
        awp_remove_dashicons_on_frontend();
        $this->assertTrue(true);
    }
}
