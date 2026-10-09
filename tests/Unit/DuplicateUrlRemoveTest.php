<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/duplicate-url-remove.php';

class DuplicateUrlRemoveTest extends TestCase {

    protected function setUp(): void {
        global $wp_test_options;
        $wp_test_options['sdr_duplicate_urls'] = "https://example.com/page-1\nhttps://example.com/page-2/\n  HTTPS://EXAMPLE.COM/PAGE-1?ref=abc  ";
    }

    public function testNormaliseUrl(): void {
        $this->assertEquals('https://example.com/test/', sdr_normalise('https://EXAMPLE.com/test'));
        $this->assertEquals('https://example.com/test/', sdr_normalise('https://example.com/test/'));
        $this->assertEquals('https://example.com/test/', sdr_normalise('https://example.com/test?query=param&foo=bar'));
        $this->assertEquals('https://example.com/test/', sdr_normalise('https://example.com/test#section-target'));
        $this->assertEquals('', sdr_normalise('   '));
    }

    public function testGetProtectedUrls(): void {
        $urls = sdr_get_protected_urls();
        $this->assertIsArray($urls);
        $this->assertCount(2, $urls); // page-1 and page-2 (page-1 duplicated with query params filtered out)
        $this->assertTrue(in_array('https://example.com/page-1/', $urls, true));
        $this->assertTrue(in_array('https://example.com/page-2/', $urls, true));
    }

    public function testDeduplicateXml(): void {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://example.com/page-1/</loc>
        <lastmod>2026-10-01</lastmod>
    </url>
    <url>
        <loc>https://example.com/page-1?extra=1</loc>
        <lastmod>2026-10-02</lastmod>
    </url>
    <url>
        <loc>https://example.com/other-unprotected-page/</loc>
    </url>
</urlset>';

        $deduped = sdr_deduplicate_xml($xml);
        $this->assertStringContainsString('https://example.com/page-1/', $deduped);
        $this->assertStringContainsString('https://example.com/other-unprotected-page/', $deduped);
        // Duplicate instance of page-1?extra=1 should be stripped
        $this->assertFalse(strpos($deduped, '<loc>https://example.com/page-1?extra=1</loc>') !== false);
    }

    public function testDeduplicateXmlEmpty(): void {
        $this->assertEquals('', sdr_deduplicate_xml(''));
    }

    public function testSitemapInterception(): void {
        $_SERVER['REQUEST_URI'] = '/sitemap_index.xml';
        sdr_intercept_sitemap_request();
        $this->assertTrue(true);
    }
}
