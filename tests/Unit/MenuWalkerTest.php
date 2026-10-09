<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/menu-walker.php';

class MenuWalkerTest extends TestCase {

    public function testNewElsnerMenuNormalItem(): void {
        $walker = new NewElsnerMenu();
        $output = '';
        $item = new stdClass();
        $item->ID = 10;
        $item->title = 'About Us';
        $item->url = 'https://example.com/about/';

        $walker->start_el($output, $item, 0, array(), 0);
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('About Us', $output);
        $this->assertStringContainsString('https://example.com/about/', $output);
    }
}
