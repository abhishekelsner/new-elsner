<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/plugins/acf-import-export-manager/includes/export-functions.php';

class AcfExportFunctionsTest extends TestCase {

    public function testArrayToXmlSimple(): void {
        $data = array(
            'post_title' => 'My Test Title',
            'post_slug'  => 'my-test-slug',
            'post_id'    => 42
        );
        $xmlStr = acf_dm_array_to_xml($data);
        $this->assertNotEmpty($xmlStr);
        $this->assertStringContainsString('<post_title>My Test Title</post_title>', $xmlStr);
        $this->assertStringContainsString('<post_slug>my-test-slug</post_slug>', $xmlStr);
        $this->assertStringContainsString('<post_id>42</post_id>', $xmlStr);
    }

    public function testArrayToXmlNestedAndNumeric(): void {
        $data = array(
            'repeater_items' => array(
                array('item_name' => 'First Row', 'item_val' => '100'),
                array('item_name' => 'Second Row', 'item_val' => '200')
            )
        );
        $xmlStr = acf_dm_array_to_xml($data);
        $this->assertNotEmpty($xmlStr);
        $this->assertStringContainsString('<item_name>First Row</item_name>', $xmlStr);
        $this->assertStringContainsString('<item_name>Second Row</item_name>', $xmlStr);
    }

    public function testGetPostAcfFields(): void {
        $fields = acf_dm_get_post_acf_fields(101);
        $this->assertIsArray($fields);
        $this->assertTrue(isset($fields['hero_title']));
        $this->assertEquals('Hero Title', $fields['hero_title']['label']);
        $this->assertEquals('Hello World Title', $fields['hero_title']['value']);
    }

    public function testGetAllPostTypeAcfFields(): void {
        $all = acf_dm_get_all_post_type_acf_fields('post');
        $this->assertIsArray($all);
        $this->assertNotEmpty($all);
    }

    public function testGetSingleFieldGroupAcfFields(): void {
        $fields = acf_dm_get_single_field_group_acf_fields(101, 'group_hero_section');
        $this->assertIsArray($fields);
        $this->assertTrue(isset($fields['hero_title']));
        $this->assertTrue(isset($fields['hero_desc']));
    }

    public function testGetAllOptionAcfFields(): void {
        $options = acf_dm_get_all_option_acf_fields();
        $this->assertIsArray($options);
    }

    public function testAddAdminNotice(): void {
        acf_dm_add_admin_notice('Notice test message', 'warning');
        global $wp_test_actions;
        $this->assertTrue(!empty($wp_test_actions['admin_notices']));
    }
}
