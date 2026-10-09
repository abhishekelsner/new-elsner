<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/plugins/advanced-custom-fields-nav-menu-field-master/nav-menu-v4.php';

class NavMenuV4Test extends TestCase {

    public function testNavMenuV4Methods(): void {
        global $acf_field_nav_menu;
        $this->assertNotNull($acf_field_nav_menu);

        $menus = $acf_field_nav_menu->get_nav_menus();
        $this->assertIsArray($menus);

        $tags = $acf_field_nav_menu->get_allowed_nav_container_tags();
        $this->assertIsArray($tags);

        $field = array(
            'id' => 1,
            'class' => 'test-class',
            'name' => 'menu_field',
            'allow_null' => 1,
            'value' => '1'
        );
        ob_start();
        $acf_field_nav_menu->create_field($field);
        $html = ob_get_clean();
        $this->assertNotEmpty($html);
        $this->assertStringContainsString('select', $html);
    }
}
