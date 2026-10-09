<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/global-elsner.php';

class GlobalElsnerTest extends TestCase {

    public function testLoadGlobal(): void {
        load_global();
        global $favicon;
        $this->assertNotEmpty($favicon);
    }

    public function testRegisterMyMenus(): void {
        register_my_menus();
        $this->assertTrue(true);
    }

    public function testGetTheContentReadingTime(): void {
        $readingTime = get_the_content_reading_time();
        $this->assertTrue($readingTime >= 1);
    }

    public function testGetHeadings(): void {
        $html = '<article><h1>First Title</h1><p>Some text</p><h2>Second Heading</h2><h3>Third Subheading</h3></article>';
        $headings = get_headings($html);
        $this->assertIsArray($headings);
        $this->assertCount(3, $headings);
    }
}
