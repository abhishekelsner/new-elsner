<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/template-functions.php';

class TemplateFunctionsTest extends TestCase {

    public function testTwentyseventeenBodyClasses(): void {
        $classes = array('custom-class');
        $result = twentyseventeen_body_classes($classes);
        $this->assertIsArray($result);
        $this->assertTrue(in_array('group-blog', $result, true));
        $this->assertTrue(in_array('hfeed', $result, true));
        $this->assertTrue(in_array('twentyseventeen-front-page', $result, true));
        $this->assertTrue(in_array('has-header-image', $result, true));
        $this->assertTrue(in_array('has-sidebar', $result, true));
    }

    public function testTwentyseventeenPanelCount(): void {
        set_theme_mod('panel_1', '10');
        set_theme_mod('panel_2', '20');
        $count = twentyseventeen_panel_count();
        $this->assertTrue($count >= 2);
    }

    public function testTwentyseventeenIsFrontpage(): void {
        $isFp = twentyseventeen_is_frontpage();
        $this->assertTrue($isFp);
    }

    public function testElsnerForce404Php(): void {
        $template = '/default/index.php';
        $res = elsner_force_404_php($template);
        $this->assertEquals($template, $res);
    }
}
