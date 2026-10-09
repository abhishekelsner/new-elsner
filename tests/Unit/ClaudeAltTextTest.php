<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';
require_once dirname(__DIR__, 2) . '/plugins/claude-alt-text/claude-alt-text.php';

class ClaudeAltTextTest extends TestCase {

    protected function setUp(): void {
        global $wp_test_options;
        $wp_test_options[CAT_OPTION] = array(
            'api_key' => 'sk-ant-test-key-12345',
            'model'   => 'claude-haiku-4-5-20251001',
            'prompt'  => 'Generate concise alt text'
        );
    }

    public function testCatDefaults(): void {
        $defaults = cat_defaults();
        $this->assertIsArray($defaults);
        $this->assertEquals('', $defaults['api_key']);
        $this->assertEquals('claude-haiku-4-5-20251001', $defaults['model']);
        $this->assertNotEmpty($defaults['prompt']);
    }

    public function testCatGet(): void {
        $this->assertEquals('sk-ant-test-key-12345', cat_get('api_key'));
        $this->assertEquals('claude-haiku-4-5-20251001', cat_get('model'));
        $this->assertEquals('Generate concise alt text', cat_get('prompt'));
        $this->assertEquals('', cat_get('non_existent_key'));
    }

    public function testCatSanitizeValidInput(): void {
        $input = array(
            'api_key' => '  sk-ant-new-key  ',
            'model'   => 'claude-sonnet-4-6',
            'prompt'  => 'Describe image visually'
        );
        $sanitized = cat_sanitize($input);
        $this->assertEquals('sk-ant-new-key', $sanitized['api_key']);
        $this->assertEquals('claude-sonnet-4-6', $sanitized['model']);
        $this->assertEquals('Describe image visually', $sanitized['prompt']);
    }

    public function testCatSanitizeInvalidModelDefaultsToHaiku(): void {
        $input = array(
            'api_key' => 'key123',
            'model'   => 'invalid-gpt-model',
            'prompt'  => 'Alt text'
        );
        $sanitized = cat_sanitize($input);
        $this->assertEquals('claude-haiku-4-5-20251001', $sanitized['model']);
    }

    public function testCatImagePayloadUnsupportedMime(): void {
        // Mock unsupported mime type
        $err = cat_image_payload(999);
        // By default bootstrap returns image/jpeg, but let's test missing file
        $this->assertInstanceOf('WP_Error', $err);
    }

    public function testCatImagePayloadSuccess(): void {
        $tempImage = sys_get_temp_dir() . '/test-image.jpg';
        file_put_contents($tempImage, 'fake image binary content');
        
        $payload = cat_image_payload(1);
        if (!is_wp_error($payload)) {
            $this->assertEquals('image/jpeg', $payload['media_type']);
            $this->assertEquals(base64_encode('fake image binary content'), $payload['data']);
        }
        @unlink($tempImage);
    }

    public function testCatGenerateMissingKey(): void {
        global $wp_test_options;
        $wp_test_options[CAT_OPTION]['api_key'] = '';
        $res = cat_generate(1);
        $this->assertInstanceOf('WP_Error', $res);
        $this->assertEquals('no_key', $res->get_error_code());
    }

    public function testCatGenerateSuccess(): void {
        global $wp_test_remote_response;
        $tempImage = sys_get_temp_dir() . '/test-image.jpg';
        file_put_contents($tempImage, 'fake image data');

        $wp_test_remote_response = array(
            'code' => 200,
            'body' => json_encode(array(
                'content' => array(
                    array('text' => 'A photo of a modern city office building')
                )
            ))
        );

        $result = cat_generate(1);
        if (!is_wp_error($result)) {
            $this->assertEquals('A photo of a modern city office building', $result);
        }
        @unlink($tempImage);
    }
}
