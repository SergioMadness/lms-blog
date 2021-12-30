<?php namespace professionalweb\lms\Blog\Tests\Remote\B2B;

use Ramsey\Uuid\Uuid;
use Mockery\MockInterface;
use Illuminate\Http\Request;
use professionalweb\lms\SAAS\Models\WebSite;
use professionalweb\lms\SAAS\Models\APIClient;
use professionalweb\lms\Blog\Tests\TestCaseRemote;
use professionalweb\lms\Common\Services\Transport;
use professionalweb\lms\Blog\Interfaces\ApiMethods;
use professionalweb\lms\Common\Interfaces\Services\DataSigner;
use professionalweb\lms\SAAS\Interfaces\Repositories\ClientRepository;
use professionalweb\lms\Common\Interfaces\Services\Transport as ITransport;

/**
 * Check blog controller
 * @package professionalweb\lms\Blog\Tests\Remote\B2B
 */
class BlogControllerTest extends TestCaseRemote
{
    protected function setUp(): void
    {
        parent::setUp();

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
        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_BLOG_LIST . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_GET,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->get($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model
     */
    public function testView(): void
    {
        $id = 1;

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_GET_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_GET,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->get($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model. Not found.
     */
    public function testView404(): void
    {
        $id = 1;

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_GET_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_GET,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andThrow(
                    new \Exception('', 404)
                );
        });

        $response = $this->get($url);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Check method to save model
     */
    public function testStore(): void
    {
        $attributes = [
            'title'    => 'test',
            'body'     => 'body',
            'preview'  => 'preview',
            'uri_code' => 'test-blog',
            'type'     => 'blog',
        ];

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_STORE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_POST,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->post($url, $attributes);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to save model. Bad country
     */
    public function testStoreBadCountry(): void
    {
        $attributes = [
            'title'    => 'test',
            'body'     => 'body',
            'preview'  => 'preview',
            'uri_code' => 'test-blog',
            'type'     => 'blog',
        ];


        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_STORE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1');

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_POST,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andThrow(
                    new \Exception('', 400)
                );
        });

        $response = $this->post($url, $attributes);

        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * Check update method
     */
    public function testUpdate(): void
    {
        $id = 1;
        $attributes = [
            'title'    => 'test',
            'body'     => 'body',
            'preview'  => 'preview',
            'uri_code' => 'test-blog',
            'type'     => 'blog',
        ];
        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_UPDATE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_PATCH,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->patch($url, $attributes);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check update method. Model not found
     */
    public function testUpdateModelNotFound(): void
    {
        $id = 1;
        $attributes = [
            'title'    => 'test',
            'body'     => 'body',
            'preview'  => 'preview',
            'uri_code' => 'test-blog',
            'type'     => 'blog',
        ];


        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_UPDATE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_PATCH,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andThrow(
                    new \Exception('', 404)
                );
        });

        $response = $this->patch($url, $attributes);

        $this->assertEquals(404, $response->getStatusCode());
    }


    /**
     * Check destroy method.
     */
    public function testRemoveModel(): void
    {
        $id = 1;

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_REMOVE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);

        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_DELETE,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andReturn(collect([]));
        });

        $response = $this->delete($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check destroy method. Model not found
     */
    public function testRemoveModelNotFound(): void
    {
        $id = 1;

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_REMOVE_BLOG . '?client_id=' . Uuid::uuid4() . '&signature=1', ['id' => $id]);
        $this->mock(ITransport::class, function (MockInterface $mock) use ($url) {
            $mock->shouldReceive('send')
                ->with(
                    \Mockery::type('string'),
                    Request::METHOD_DELETE,
                    \Mockery::type('array'),
                    \Mockery::type('array')
                )
                ->once()
                ->andThrow(
                    new \Exception('', 404)
                );;
        });

        $response = $this->delete($url);

        $this->assertEquals(404, $response->getStatusCode());
    }
}