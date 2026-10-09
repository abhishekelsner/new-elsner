<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/schema-functions.php';

class SchemaFunctionsTest extends TestCase {

    public function testGenerateFaqSchema(): void {
        $schema = generate_faq_schema();
        // Returns schema array or null depending on ACF field setup
        if ($schema !== null) {
            $this->assertIsArray($schema);
            $this->assertEquals('https://schema.org', $schema['@context']);
            $this->assertEquals('FAQPage', $schema['@type']);
        } else {
            $this->assertNull($schema);
        }
    }
}
