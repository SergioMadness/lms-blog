<?php namespace professionalweb\LMS\Blog\Tests\Remote\B2B;

use Mockery\MockInterface;
use Illuminate\Http\Request;
use professionalweb\LMS\Blog\Tests\TestCaseRemote;
use professionalweb\LMS\Common\Services\Transport;
use professionalweb\LMS\Blog\Interfaces\ApiMethods;
use professionalweb\LMS\Common\Interfaces\Services\Transport as ITransport;

/**
 * Check blog controller
 * @package professionalweb\LMS\Blog\Tests\Remote\B2B
 */
class BlogControllerTest extends TestCaseRemote
{
    /**
     * Index method
     */
    public function testIndex(): void
    {
        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_BLOG_LIST);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_GET,
                \Mockery::type('array'),
                \Mockery::type('array')
            )
            ->once()
            ->andReturn(json_encode([]));

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

        $response = $this->get($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model
     */
    public function testView(): void
    {
        $id = 1;

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_GET_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_GET,
                \Mockery::type('array'),
                \Mockery::type('array')
            )
            ->once()
            ->andReturn(json_encode([]));

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

        $response = $this->get($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check method to get single model. Not found.
     */
    public function testView404(): void
    {
        $id = 1;

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_GET_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_GET,
                \Mockery::type('array'),
                \Mockery::type('array')
            )
            ->once()
            ->andThrow(
                new \Exception('', 404)
            );

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

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

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_STORE_BLOG);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_POST,
                \Mockery::on(function ($arg) use ($attributes) {
                    return \count(array_intersect_assoc($arg, $attributes)) === \count($attributes);
                }),
                \Mockery::type('array')
            )
            ->once()
            ->andReturn(json_encode($attributes));

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

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

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_STORE_BLOG);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_POST,
                \Mockery::on(function ($arg) use ($attributes) {
                    return \count(array_intersect_assoc($arg, $attributes)) === \count($attributes);
                }),
                \Mockery::type('array')
            )
            ->once()
            ->andThrow(
                new \Exception('error', 400)
            );

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

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

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_UPDATE_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_PATCH,
                \Mockery::on(function ($arg) use ($attributes) {
                    return \count(array_intersect_assoc($arg, $attributes)) === \count($attributes);
                }),
                \Mockery::type('array')
            )
            ->once()
            ->andReturn(json_encode($attributes));

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

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

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_UPDATE_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_PATCH,
                \Mockery::on(function ($arg) use ($attributes) {
                    return \count(array_intersect_assoc($arg, $attributes)) === \count($attributes);
                }),
                \Mockery::type('array')
            )
            ->once()
            ->andThrow(
                new \Exception('error', 404)
            );

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

        $response = $this->patch($url, $attributes);

        $this->assertEquals(404, $response->getStatusCode());
    }


    /**
     * Check destroy method.
     */
    public function testRemoveModel(): void
    {
        $id = 1;

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_REMOVE_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_DELETE,
                \Mockery::type('array'),
                \Mockery::type('array')
            )
            ->once()
            ->andReturn(json_encode([]));

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

        $response = $this->delete($url);

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * Check destroy method. Model not found
     */
    public function testRemoveModelNotFound(): void
    {
        $id = 1;

        $mockery = \Mockery::mock(Transport::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $url = $this->prepareUrl('/api/v2/b2b' . ApiMethods::API_METHOD_REMOVE_BLOG, ['id' => $id]);
        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $url,
                Request::METHOD_DELETE,
                \Mockery::type('array'),
                \Mockery::type('array')
            )
            ->once()
            ->andThrow(
                new \Exception('error', 404)
            );

        /** @var MockInterface|Transport $mock */
        $mock = $expectations->getMock();

        $mock->setBaseUrl('')->setClientId('')->setSecretId('');

        $this->instance(ITransport::class, $mock);

        $response = $this->delete($url);

        $this->assertEquals(404, $response->getStatusCode());
    }
}