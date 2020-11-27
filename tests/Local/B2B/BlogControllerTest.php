<?php namespace professionalweb\LMS\Blog\Tests\Local\B2B;

use Ramsey\Uuid\Uuid;
use Mockery\MockInterface;
use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Blog\Tests\TestCase;
use professionalweb\LMS\SAAS\Models\WebSite;
use professionalweb\LMS\SAAS\Models\APIClient;
use professionalweb\LMS\Common\Interfaces\WithPagination;
use professionalweb\LMS\Common\Interfaces\Services\DataSigner;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\SAAS\Interfaces\Repositories\ClientRepository;

/**
 * Check blog controller
 * @package professionalweb\LMS\Blog\Tests\Local\B2B
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

        $clientModel = new APIClient();
        $clientModel->key = 'test';
        $clientModel->website = new WebSite();

        $this->mock(ClientRepository::class, function (MockInterface $mock) use ($clientModel) {
            $mock->shouldReceive('model')
                ->once()
                ->andReturn($clientModel);
        });
        $this->mock(DataSigner::class, function (MockInterface $mock) use ($clientModel) {
            $mock->shouldReceive('validate')
                ->once()
                ->andReturnTrue();
        });
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

        $response = $this->get('/api/v2/b2b/blog?client_id=' . Uuid::uuid4() . '&signature=1');

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

        $response = $this->get('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1');

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

        $response = $this->get('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Check method to save model
     */
    public function testStore(): void
    {
        $attributes = [
            'title'        => 'test',
            'body'         => 'body',
            'preview'      => 'preview',
            'uri_code'     => 'test-blog',
            'publish_date' => date('Y-m-d'),
        ];

        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('create')->once()->andReturn($this->blogMock);
            $mock->shouldReceive('save')->once()->andReturnTrue();
        });

        $response = $this->post('/api/v2/b2b/blog?client_id=' . Uuid::uuid4() . '&signature=1', $attributes);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check update method
     */
    public function testUpdate(): void
    {
        $id = 1;
        $attributes = [
            'title'        => 'test',
            'body'         => 'body',
            'preview'      => 'preview',
            'uri_code'     => 'test-blog',
            'publish_date' => date('Y-m-d'),
        ];

        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturnTrue();
            $mock->shouldReceive('model')->once()->andReturn($this->blogMock);
            $mock->shouldReceive('fill')->once()->andReturn($this->blogMock);
        });

        $response = $this->patch('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1', $attributes);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check update method. Model not found
     */
    public function testUpdateModelNotFound(): void
    {
        $id = 1;
        $attributes = [
            'title'        => 'test',
            'body'         => 'body',
            'preview'      => 'preview',
            'uri_code'     => 'test-blog',
            'publish_date' => date('Y-m-d'),
        ];

        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->never();
            $mock->shouldReceive('model')->once()->andReturn(null);
            $mock->shouldReceive('fill')->never();
        });

        $response = $this->patch('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1', $attributes);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Check destroy method.
     */
    public function testRemoveModel(): void
    {
        $id = 1;

        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('remove')->once();
            $mock->shouldReceive('model')->once()->andReturn($this->blogMock);
        });

        $response = $this->delete('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check destroy method. Model not found
     */
    public function testRemoveModelNotFound(): void
    {
        $id = 1;

        $this->mock(BlogRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('remove')->never();
            $mock->shouldReceive('model')->once()->andReturn(null);
        });

        $response = $this->delete('/api/v2/b2b/blog/' . $id . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->assertEquals(404, $response->getStatusCode());
    }
}