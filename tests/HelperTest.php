<?php

namespace lerivera\HelperProject;

use PHPUnit\Framework\TestCase;

final class HelperTest extends TestCase
{
  private $helper;

  protected function setUp(): void
  {
    $this->helper = new Helper();
  }

  public function testMultiply()
  {
    $this->assertEquals(8, $this->helper->multiply(2, 4), '2x4 should be 8');
    $this->assertEquals(8, $this->helper->multiply(4, 2), '4x2 should be 8');

    $this->assertEquals(-8, $this->helper->multiply(-2, 4), '-2x4 should be -8');
    $this->assertEquals(-8, $this->helper->multiply(4, -2), '4x-2 should be -8');

    $this->assertEquals(-8, $this->helper->multiply(2, -4), '2x-4 should be -8');
    $this->assertEquals(-8, $this->helper->multiply(-4, 2), '-4x2 should be -8');

    $this->assertEquals(8, $this->helper->multiply(-2, -4), '-2x-4 should be 8');
    $this->assertEquals(8, $this->helper->multiply(-4, -2), '-4x-2 should be 8');

    $this->assertEquals(0, $this->helper->multiply(0, 4), '0x4 should be 0');
    $this->assertEquals(0, $this->helper->multiply(4, 0), '4x0 should be 0');
  }

  public function testMax()
  {
    $this->assertEquals(-8, $this->helper->array_max([-15, -8, -10, -232]), 'array_max([-15, -8, -10, -232]) should be -8');
    $this->assertEquals(293, $this->helper->array_max([-15, -8, -10, -232, 293, 42]), 'array_max([-15, -8, -10, -232, 293, 42]) should be -8');
    $this->assertEquals(-8, $this->helper->array_max(['primo', -15, -8, -10, -232, 'ultimo']), 'array_max([\'primo\', -15, -8, -10, -232, \'ultimo\']) should be -8');
    $this->assertEquals(null, $this->helper->array_max(['todos', 'son', 'strings']), 'array_max([\'todos\', \'son\', \'strings\']) should be null');
  }

  public function testRemoveFalsy()
  {
    $this->assertEqualsCanonicalizing(['0'], $this->helper->remove_falsy([false, null, 0, '0']), "remove_falsy([false, null, 0, '0']) should be ['0']");
    $this->assertEqualsCanonicalizing(['0', 'otra'], $this->helper->remove_falsy([false, 'otra', null, 0, '0']), "remove_falsy([false, 'otra', null, 0, '0']) should be ['0', 'otra']");
  }

  public function testFlattenRecursively()
  {
    $this->assertEqualsCanonicalizing([1, 2, 3, 4, 'hola', 1, 'buenos dias'], $this->helper->flatten_recursively([1, [2, [3, 4]], 'hola', [1, 'buenos dias']]));
  }

  public function testRepeatedWord()
  {
    $this->assertEqualsCanonicalizing(['es' => 3], $this->helper->repeated_word("Este es un string, el cual es un string donde se repite muchas veces la palabra es"));
  }

  public function testIsPalindrome()
  {
    $this->assertEquals(true, $this->helper->is_palindrome('Menem'), 'Menem should be a palindrome');
    $this->assertEquals(true, $this->helper->is_palindrome('123321'), '1234321 should be a palindrome');
    $this->assertEquals(false, $this->helper->is_palindrome('Menyem'), 'Menyem should not be a palindrome');
  }

  public function testGetMaxNumber()
  {
    $this->assertEquals(15, $this->helper->get_max_number(-1, -5, 4, 15, -5, 2));
  }
}
