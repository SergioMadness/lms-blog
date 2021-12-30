<?php namespace professionalweb\lms\Blog\Tests\Remote\B2C;

use Mockery\MockInterface;
use Illuminate\Http\Request;
use professionalweb\lms\Blog\Tests\TestCaseRemote;
use professionalweb\lms\Common\Services\Transport;
use professionalweb\lms\Blog\Interfaces\ApiMethods;
use professionalweb\lms\Common\Interfaces\Services\Transport as ITransport;

/**
 * Check news controller
 * @package professionalweb\lms\Blog\Tests\Remote\B2C
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

        $expectations = $mockery
            ->shouldReceive('sendRequest')
            ->with(
                $this->prepareUrl('/api/v2' . ApiMethods::API_METHOD_BLOG_LIST),
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

        $response = $this->get('/api/v2' . ApiMethods::API_METHOD_BLOG_LIST);

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

        $url = $this->prepareUrl('/api/v2' . ApiMethods::API_METHOD_GET_BLOG, ['id' => $id]);
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

        $url = $this->prepareUrl('/api/v2' . ApiMethods::API_METHOD_GET_BLOG, ['id' => $id]);
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
}