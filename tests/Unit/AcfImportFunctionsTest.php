<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/plugins/acf-import-export-manager/includes/import-functions.php';

class AcfImportFunctionsTest extends TestCase {

    public function testXmlToArrayValid(): void {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<acf_export>
    <post_title>Imported Post Title</post_title>
    <post_slug>imported-slug</post_slug>
    <post_type>page</post_type>
</acf_export>';

        $arr = acf_dm_xml_to_array($xml);
        $this->assertIsArray($arr);
        $this->assertEquals('Imported Post Title', $arr['post_title']);
        $this->assertEquals('imported-slug', $arr['post_slug']);
        $this->assertEquals('page', $arr['post_type']);
    }

    public function testXmlToArrayEmpty(): void {
        $arr = acf_dm_xml_to_array('');
        $this->assertIsArray($arr);
        $this->assertEmpty($arr);
    }

    public function testXmlToArrayMalformed(): void {
        $arr = acf_dm_xml_to_array('<broken><unclosed></broken>');
        $this->assertIsArray($arr);
    }

    public function testGenerateMappingTable(): void {
        $items = array(
            array(
                'source_id'    => 101,
                'source_title' => 'Services Page',
                'source_slug'  => 'services',
                'source_type'  => 'page',
                'acf_fields'   => array('hero_title' => array('value' => 'Our Services'))
            )
        );

        $html = acf_dm_generate_mapping_table($items);
        $this->assertNotEmpty($html);
        $this->assertStringContainsString('Services Page', $html);
        $this->assertStringContainsString('table', $html);
        $this->assertStringContainsString('select', $html);
    }
}
