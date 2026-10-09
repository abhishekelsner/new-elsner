<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';

class TrackingInfoFunctionsTest extends TestCase {

    public function testTrackingDataFunctions(): void {
        $_SERVER['HTTP_HOST'] = 'example.com';
        $_SERVER['REQUEST_URI'] = '/test-page/';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/functions/tracking-info-functions.php';

        initialize_tracking_data();
        global $tracking_data;
        $this->assertIsArray($tracking_data);
        $this->assertEquals('127.0.0.1', $tracking_data['user_ip_address']);

        $formData = array('your-name' => 'John Doe', 'your-email' => 'john@example.com');
        $merged = add_tracking_data_to_form($formData);
        $this->assertIsArray($merged);
        $this->assertEquals('John Doe', $merged['your-name']);
        $this->assertEquals('127.0.0.1', $merged['user_ip_address']);

        clear_tracking_session();
        $this->assertFalse(isset($_SESSION['entry_url']));
    }
}
