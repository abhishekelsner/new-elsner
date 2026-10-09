<?php
/**
 * Base TestCase class compatible with PHPUnit and standalone runner.
 */

if (class_exists('PHPUnit\\Framework\\TestCase')) {
    class BaseTestCaseBridge extends \PHPUnit\Framework\TestCase {}
} else {
    class BaseTestCaseBridge {
        public static function setUpBeforeClass(): void {}
        public static function tearDownAfterClass(): void {}
        protected function setUp(): void {}
        protected function tearDown(): void {}

        public static function assertEquals($expected, $actual, string $message = ''): void {
            if ($expected != $actual) {
                throw new \AssertionError($message ?: "Failed asserting that " . json_encode($actual) . " matches expected " . json_encode($expected));
            }
        }

        public static function assertSame($expected, $actual, string $message = ''): void {
            if ($expected !== $actual) {
                throw new \AssertionError($message ?: "Failed asserting that " . json_encode($actual) . " is identical to " . json_encode($expected));
            }
        }

        public static function assertTrue($condition, string $message = ''): void {
            if ($condition !== true) {
                throw new \AssertionError($message ?: "Failed asserting that value is true");
            }
        }

        public static function assertFalse($condition, string $message = ''): void {
            if ($condition !== false) {
                throw new \AssertionError($message ?: "Failed asserting that value is false");
            }
        }

        public static function assertNull($actual, string $message = ''): void {
            if ($actual !== null) {
                throw new \AssertionError($message ?: "Failed asserting that value is null");
            }
        }

        public static function assertNotNull($actual, string $message = ''): void {
            if ($actual === null) {
                throw new \AssertionError($message ?: "Failed asserting that value is not null");
            }
        }

        public static function assertCount(int $expectedCount, $haystack, string $message = ''): void {
            $cnt = is_countable($haystack) ? count($haystack) : 0;
            if ($cnt !== $expectedCount) {
                throw new \AssertionError($message ?: "Failed asserting that count is $expectedCount (actual: $cnt)");
            }
        }

        public static function assertStringContainsString(string $needle, string $haystack, string $message = ''): void {
            if (strpos($haystack, $needle) === false) {
                throw new \AssertionError($message ?: "Failed asserting that '$haystack' contains '$needle'");
            }
        }

        public static function assertIsArray($actual, string $message = ''): void {
            if (!is_array($actual)) {
                throw new \AssertionError($message ?: "Failed asserting that value is an array");
            }
        }

        public static function assertNotEmpty($actual, string $message = ''): void {
            if (empty($actual)) {
                throw new \AssertionError($message ?: "Failed asserting that value is not empty");
            }
        }

        public static function assertEmpty($actual, string $message = ''): void {
            if (!empty($actual)) {
                throw new \AssertionError($message ?: "Failed asserting that value is empty");
            }
        }

        public static function assertIsString($actual, string $message = ''): void {
            if (!is_string($actual)) {
                throw new \AssertionError($message ?: "Failed asserting that value is a string");
            }
        }

        public static function assertInstanceOf(string $expected, $actual, string $message = ''): void {
            if (!($actual instanceof $expected)) {
                $actualType = is_object($actual) ? get_class($actual) : gettype($actual);
                throw new \AssertionError($message ?: "Failed asserting that $actualType is an instance of $expected");
            }
        }
    }
}

abstract class TestCase extends BaseTestCaseBridge {
}
