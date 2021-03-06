<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    static public function dataInvalidInteger()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
            array("10"),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INTEGER);
        Assertion::integer($nonInteger);
    }

    public function testValidInteger()
    {
        Assertion::integer(10);
        Assertion::integer(0);
    }

    public function testValidIntegerish()
    {
        Assertion::integerish(10);
        Assertion::integerish("10");
    }

    static public function dataInvalidIntegerish()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
        );

    }

    /**
     * @dataProvider dataInvalidIntegerish
     */
    public function testInvalidIntegerish($nonInteger)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INTEGERISH);
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        Assertion::boolean(true);
        Assertion::boolean(false);
    }

    public function testInvalidBoolean()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_BOOLEAN);
        Assertion::boolean(1);
    }

    static public function dataInvalidNotEmpty()
    {
        return array(
            array(""),
            array(false),
            array(0),
            array(null),
            array( array() ),
        );
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     */
    public function testInvalidNotEmpty($value)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_EMPTY);
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        Assertion::notEmpty("test");
        Assertion::notEmpty(1);
        Assertion::notEmpty(true);
        Assertion::notEmpty( array("foo") );
    }

    public function testNotNull()
    {
        Assertion::notNull("1");
        Assertion::notNull(1);
        Assertion::notNull(0);
        Assertion::notNull(array());
        Assertion::notNull(false);
    }

    public function testInvalidNotNull()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_NULL);
        Assertion::notNull(null);
    }

    public function testInvalidRegex()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_REGEX);
        Assertion::regex("foo", "(bar)");
    }

    public function testInvalidRegexValueNotString()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING);
        Assertion::regex(array("foo"), "(bar)");
    }

    public function testInvalidMinLength()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::minLength("foo", 4);
    }

    public function testInvalidMaxLength()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::maxLength("foo", 2);
    }

    public function testInvalidBetweenLengthMin()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::betweenLength("foo", 4, 100);
    }

    public function testInvalidBetweenLengthMax()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::betweenLength("foo", 0, 2);
    }

    public function testValidBetweenLength()
    {
        Assertion::betweenLength("foo", 0, 3);
    }

    public function testInvalidStartsWith()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_START);
        Assertion::startsWith("foo", "bar");
    }

    public function testValidStartsWith()
    {
        Assertion::startsWith("foo", "foo");
        Assertion::startsWith("foo", "fo");
        Assertion::startsWith("foo", "f");
    }

    public function testInvalidContains()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_CONTAINS);
        Assertion::contains("foo", "bar");
    }

    public function testValidContains()
    {
        Assertion::contains("foo", "foo");
        Assertion::contains("foo", "oo");
    }

    public function testInvalidChoice()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CHOICE);
        Assertion::choice("foo", array("bar", "baz"));
    }

    public function testValidChoice()
    {
        Assertion::choice("foo", array("foo"));
    }

    public function testValidInarray()
    {
        Assertion::inArray("foo", array("foo"));
    }

    public function testInvalidNumeric()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NUMERIC);
        Assertion::numeric("foo");
    }

    public function testValidNumeric()
    {
        Assertion::numeric("1");
        Assertion::numeric(1);
        Assertion::numeric(1.23);
    }

    public function testInvalidKeyExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_KEY_EXISTS);
        Assertion::keyExists(array("foo" => "bar"), "baz");
    }

    public function testValidKeyExists()
    {
        Assertion::keyExists(array("foo" => "bar"), "foo");
    }

    public function testInvalidnotBlank()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_BLANK);
        Assertion::notBlank("");
    }

    public function testValidNotBlank()
    {
        Assertion::notBlank("foo");
    }

    public function testInvalidInstanceOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INSTANCE_OF);
        Assertion::isInstanceOf(new \stdClass, 'PDO');
    }

    public function testValidInstanceOf()
    {
        Assertion::isInstanceOf(new \stdClass, 'stdClass');
    }

    public function testInvalidSubclassOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SUBCLASS_OF);
        Assertion::subclassOf(new \stdClass, 'PDO');
    }

    public function testValidSubclassOf()
    {
        Assertion::subclassOf(new ChildStdClass, 'stdClass');
    }

    public function testInvalidRange()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_RANGE);
        Assertion::range(1, 2, 3);
    }

    public function testValidRange()
    {
        Assertion::range(1, 1, 2);
        Assertion::range(2, 1, 2);
        Assertion::range(2, 0, 100);
    }

    public function testInvalidEmail()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EMAIL);
        Assertion::email("foo");
    }

    public function testValidEmail()
    {
        Assertion::email("123hello+world@email.provider.com");
    }

    public function testInvalidDigit()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIGIT);
        Assertion::digit(-1);
    }

    public function testValidDigit()
    {
        Assertion::digit(1);
        Assertion::digit(0);
        Assertion::digit("0");
    }

    public function testValidAlnum()
    {
        Assertion::alnum("a");
        Assertion::alnum("a1");
        Assertion::alnum("aasdf1234");
        Assertion::alnum("a1b2c3");
    }

    public function testInvalidAlnum()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_ALNUM);
        Assertion::alnum("1a");
    }

    public function testValidTrue()
    {
        Assertion::true(1 == 1);
    }

    public function testInvalidTrue()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_TRUE);
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        Assertion::false(1 == 0);
    }

    public function testInvalidFalse()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_FALSE);
        Assertion::false(true);
    }

    public function testInvalidClass()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CLASS);
        Assertion::classExists("Foo");
    }

    public function testValidClass()
    {
        Assertion::classExists("\\Exception");
    }

    public function testSame()
    {
        Assertion::same(1,1);
        Assertion::same("foo","foo");
        Assertion::same($obj = new \stdClass(), $obj);
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SAME);
        Assertion::same(new \stdClass(), new \stdClass());
    }

    public function testEq()
    {
        Assertion::eq(1,"1");
        Assertion::eq("foo",true);
        Assertion::eq($obj = new \stdClass(), $obj);
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EQ);
        Assertion::eq("2", 1);
    }

    public function testMin()
    {
        Assertion::min(1, 1);
        Assertion::min(2, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN);
        Assertion::min(0, 1);
    }

    public function testMax()
    {
        Assertion::max(1, 1);
        Assertion::max(0, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX);
        Assertion::max(2, 1);
    }

    public function testNullOr()
    {
        Assertion::nullOrMax(null, 1);
        Assertion::nullOrMax(null, 2);
    }

    public function testLength()
    {
        Assertion::length("asdf", 4);
        Assertion::length("", 0);
    }

    public function testLengthFailed()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_LENGTH);
        Assertion::length("asdf", 3);
    }

    public function testFile()
    {
        Assertion::file(__FILE__);
    }

    public function testFileWithEmptyFilename()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_EMPTY);
        Assertion::file("");
    }

    public function testFileDoesNotExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_FILE);
        Assertion::file(__DIR__ . '/does-not-exists');
    }

    public function testDirectory()
    {
        Assertion::directory(__DIR__);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIRECTORY);
        Assertion::directory(__DIR__ . '/does-not-exist');
    }

}

class ChildStdClass extends \stdClass
{

}

