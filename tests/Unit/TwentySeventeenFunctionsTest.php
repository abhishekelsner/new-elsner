<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/twentyseventeen-functions.php';

class TwentySeventeenFunctionsTest extends TestCase {

    public function testTwentyseventeenSetup(): void {
        twentyseventeen_setup();
        $this->assertEquals(525, $GLOBALS['content_width']);
    }
}
