<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/plugins/acf-import-export-manager/includes/admin-menu.php';

class AcfAdminMenuTest extends TestCase {

    public function testAddAdminMenu(): void {
        acf_dm_add_admin_menu();
        $this->assertTrue(true);
    }

    public function testRenderAdminPage(): void {
        ob_start();
        acf_dm_render_admin_page();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('ACF Data Manager', $output);
        $this->assertStringContainsString('Export ACF Fields', $output);
        $this->assertStringContainsString('acf_dm_export_nonce', $output);
    }
}
