<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once dirname(__DIR__) . '/TestCase.php';

class PaypalFunctionsTest extends TestCase {

    public function testGetPostSessionHelpers(): void {
        $_GET['action_test'] = 'checkout';
        $_POST['item_name'] = 'SEO Package';
        $_SESSION['token_test'] = 'tok_123456';

        require_once dirname(__DIR__, 2) . '/themes/Elsner-Revemp/inc/paypal/functions.php';

        $this->assertEquals('checkout', _GET('action_test'));
        $this->assertEquals('default_val', _GET('non_existent', 'default_val'));
        $this->assertEquals('SEO Package', _POST('item_name'));
        $this->assertEquals('tok_123456', _SESSION('token_test'));
    }
}
