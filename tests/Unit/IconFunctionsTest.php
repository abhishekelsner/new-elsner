<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/icon-functions.php';

class IconFunctionsTest extends TestCase {

    public function testTwentyseventeenGetSvgValid(): void {
        $svg = twentyseventeen_get_svg(array(
            'icon'  => 'facebook',
            'title' => 'Facebook Icon'
        ));
        $this->assertNotEmpty($svg);
        $this->assertStringContainsString('<svg class="icon icon-facebook"', $svg);
        $this->assertStringContainsString('Facebook Icon', $svg);
    }

    public function testTwentyseventeenGetSvgMissingArgs(): void {
        $msg = twentyseventeen_get_svg();
        $this->assertStringContainsString('Please define default parameters', $msg);
    }

    public function testTwentyseventeenGetSvgMissingIcon(): void {
        $msg = twentyseventeen_get_svg(array('title' => 'Test'));
        $this->assertStringContainsString('Please define an SVG icon filename', $msg);
    }
}
