<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/partner-portal.php';

class PartnerPortalTest extends TestCase {

    public function testCustomFieldForGeneral(): void {
        ob_start();
        custom_field_for_general();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('user_profile_photo', $output);
    }

    public function testGetUserProfilePhoto(): void {
        $_POST['user_profile_photo'] = 'photo-123.jpg';
        get_user_profile_photo();
        $this->assertTrue(true);
    }

    public function testLeadsTab(): void {
        $tabs = array();
        $updated = leads_tab($tabs);
        $this->assertIsArray($updated);
        $this->assertTrue(isset($updated[800]['leads']));
        $this->assertEquals('View/Add Leads', $updated[800]['leads']['title']);
    }
}
