<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/elsner-mega-menu.php';

class ElsnerMegaMenuTest extends TestCase {

    public function testElsnerMainMenuAtts(): void {
        $item = new stdClass();
        $item->classes = array('menu-item', 'children');
        $atts = array('href' => 'https://example.com/services');

        $result = elsner_main_menu_atts($atts, $item, array());
        $this->assertIsArray($result);
        $this->assertEquals('https://example.com/services', $result['href']);
    }

    public function testStagingElsnerMegaMenuEndEl(): void {
        $walker = new StagingElsnerMegaMenu();
        $output = '';
        $item = new stdClass();
        $item->ID = 10;
        $walker->end_el($output, $item, 0, array());
        $this->assertIsString($output);
    }
}
