<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/ajax-filters.php';

class AjaxFiltersTest extends TestCase {

    public function testSearchBlogPosts(): void {
        $_POST['search'] = 'wordpress design';
        $_POST['href'] = 'technology';
        ob_start();
        search_blog_posts();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('blog-card', $output);
    }

    public function testElsnerAjaxLoadMoreBlogs(): void {
        $_POST['page'] = '1';
        $_POST['termID'] = 'all';
        $_POST['search'] = '';
        ob_start();
        elsner_ajax_load_more_blogs();
        $output = ob_get_clean();
        $this->assertNotEmpty($output);
        $this->assertStringContainsString('blog-card', $output);
    }
}
