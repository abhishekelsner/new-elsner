<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/template-tags.php';

class TemplateTagsTest extends TestCase {

    public function testTwentyseventeenTimeLink(): void {
        $link = twentyseventeen_time_link();
        $this->assertNotEmpty($link);
        $this->assertStringContainsString('<time class="entry-date published updated"', $link);
        $this->assertStringContainsString('https://example.com/sample-post/', $link);
    }

    public function testTwentyseventeenPostedOn(): void {
        ob_start();
        twentyseventeen_posted_on();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('posted-on', $output);
        $this->assertStringContainsString('byline', $output);
    }
}
