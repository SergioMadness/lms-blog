<?php namespace professionalweb\LMS\Blog\Tests\Local\B2C;

use Mockery\MockInterface;
use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Blog\Tests\TestCase;
use professionalweb\LMS\Common\Interfaces\WithPagination;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Check blog controller
 * @package professionalweb\LMS\Blog\Tests\Local\B2C
 */
class BlogControllerTest extends TestCase
{
    /**
     * @var Blog|MockInterface
     */
    private $blogMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blogMock = new Blog();
    }

    /**
     * Index method
     */
    public function testIndex(): void
    {
        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->with([], ['publish_date' => 'desc'], WithPagination::PAGINATION_DEFAULT_LIMIT, 0)
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->get('/api/v2/b2b/blog');

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model
     */
    public function testView(): void
    {
        $id = 1;

        $this->mock(BlogRepository::class, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('model')
                ->with($id)
                ->once()
                ->andReturn($this->blogMock);
        });

        $response = $this->get('/api/v2/b2b/blog/' . $id);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model. Not found.
     */
    public function testView404(): void
    {
        $id = 1;

        $this->mock(BlogRepository::class, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('model')
                ->with($id)
                ->once()
                ->andReturn(null);
        });

        $response = $this->get('/api/v2/b2b/blog/' . $id);

        $this->assertEquals(404, $response->getStatusCode());
    }
}