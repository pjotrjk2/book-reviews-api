<?php declare(strict_types=1);

namespace Entity;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
    }

    public function test_book_can_be_created_with_valid_data(): void
    {
        $book = new Book();
        $book->setTile("Book title")
            ->setIsbn("9780261103283")
            ->setAuthor("Test Author");

        $this->assertEquals("Book title", $book->getTitle());
        $this->assertEquals("9780261103283", $book->getIsbn());
        $this->assertEquals("Test Author", $book->getAuthor());
    }

    public function test_book_must_have_title(): void
    {
        $book = new Book();
        $book->setAuthor("Test Author")
            ->setIsbn("9780261103283");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('title', $violations->get(0)->getPropertyPath());

        $book->setTile("");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('title', $violations->get(0)->getPropertyPath());
    }

    public function test_book_must_have_valid_isbn(): void
    {
        $book = new Book();
        $book->setTile("Book title")
            ->setAuthor("Test Author");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('isbn', $violations->get(0)->getPropertyPath());

        $book->setIsbn("");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('isbn', $violations->get(0)->getPropertyPath());

        $book->setIsbn("Invalid isbn");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('isbn', $violations->get(0)->getPropertyPath());
    }

    public function test_book_must_have_author(): void
    {
        $book = new Book();
        $book->setTile("Book title")
            ->setIsbn("9780261103283");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('author', $violations->get(0)->getPropertyPath());

        $book->setAuthor("");

        $violations = $this->validator->validate($book);
        $this->assertEquals(1, $violations->count());
        $this->assertEquals('author', $violations->get(0)->getPropertyPath());
    }

    public function test_book_isbn_must_be_unique(): void
    {
        // This test requires database integration
        $this->markTestSkipped("Will be implemented as functional test");
    }
}
