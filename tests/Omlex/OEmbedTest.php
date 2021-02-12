<?php

namespace Omlex\Tests;

use Omlex\Component\AbstractComponent;
use Omlex\Provider\YouTube;
use Omlex\OEmbed;
use Omlex\Discoverer;
use Omlex\Exception\ComponentException;

class OEmbedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Array of test components to fetch and validate.
     *
     * @var array
     */
    protected $components = [
        'photo' => [
            'url' => 'https://www.flickr.com/photos/jtellolopez/2656764466/',
            'api' => 'https://www.flickr.com/services/oembed/',
            'expected' => [
                'version' => '1.0',
                'type' => 'photo',
                'author_url' => 'https://www.flickr.com/photos/24887479@N06/',
                'cache_age' => 3600,
                'provider_name' => 'Flickr',
                'provider_url' => 'https://www.flickr.com/',
                'title' => 'Torrie Wilson',
                'author_name' => 'jtellolopez',
                'width' => '842',
                'height' => '1024',
                'url' => 'https://live.staticflickr.com/3245/2656764466_afa90677e1_b.jpg',
            ],
        ],
        'video' => [
            'url' => 'https://www.youtube.com/watch?v=ReSxgDpAJwk',
            'api' => 'https://www.youtube.com/oembed/',
            'expected' => [
                'provider_url' => 'https://www.youtube.com/',
                'title' => 'torrie wilson vs trish stratus',
                'html' => '<iframe width="459" height="344" src="https://www.youtube.com/embed/ReSxgDpAJwk?feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'author_name' => 'johnnyg08',
                'height' => 344,
                'thumbnail_width' => 480,
                'width' => 459,
                'version' => '1.0',
                'author_url' => 'https://www.youtube.com/user/johnnyg08',
                'provider_name' => 'YouTube',
                'thumbnail_url' => 'https://i.ytimg.com/vi/ReSxgDpAJwk/hqdefault.jpg',
                'type' => 'video',
                'thumbnail_height' => 360,
            ],
        ],
    ];

    /**
     * An invalid component to test.
     *
     * @var array
     */
    protected $error = [
        'url' => 'https://www.flickr.com/photos/jtellolopez/2656764466/',
        'api' => 'https://www.flickr.com/services/oembed/',
    ];

    /**
     * A component that does not exist.
     *
     * @var array
     */
    protected $notFound = [
        'url' => 'https://www.flickr.com/photos/jtellolopez/265676446621323/',
        'api' => 'https://www.flickr.com/services/oembed/',
    ];

    /**
     * Test fetching all of the components.
     */
    public function testGetComponents()
    {
        foreach ($this->components as $type => $test) {
            $component = $this->getComponent($test);

            $expectedComponent = '\\Omlex\\Component\\'.ucfirst($type);
            $this->assertInstanceof($expectedComponent, $component);

            foreach ($test['expected'] as $key => $val) {
                $this->assertEquals($val, $component->$key, sprintf('Unexpected %s value for component type %s', $key, $type));
            }
        }
    }

    /**
     * Test the error.
     */
    public function testError()
    {
        $this->markTestSkipped('Component seems to be valid');

        try {
            $component = $this->getComponent($this->error);
        } catch (ComponentException $e) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testNotFoundError()
    {
        $component = $this->getComponent($this->notFound);
    }

    public function testRemoveProvider()
    {
        $omlex = new OEmbed();
        $providers = $omlex->getProviders();

        $providerCount = count($providers);
        $omlex->removeProvider($providers[0]);
        $this->assertEquals($providerCount - 1, count($omlex->getProviders()));
    }

    public function testAddProvider()
    {
        $omlex = new OEmbed(null, null, [], false);
        $yt = new YouTube();
        $omlex->addProvider($yt);

        $providers = $omlex->getProviders();
        $this->assertEquals(1, count($providers));
        $this->assertEquals($yt, $providers[0]);
    }

    public function testClearProviders()
    {
        $omlex = new OEmbed();
        $this->assertNotEmpty($omlex->getProviders());
        $omlex->clearProviders();
        $this->assertEmpty($omlex->getProviders());
    }

    public function testDiscovery()
    {
        $omlex = new OEmbed();
        $this->assertEquals(true, $omlex->getDiscovery());
        $omlex->setDiscovery(false);

        $this->assertEquals(false, $omlex->getDiscovery());
    }

    public function testDiscoverer()
    {
        $omlex = new OEmbed();
        $this->assertNull($omlex->getDiscoverer());

        $discoverer = new Discoverer();
        $omlex->setDiscoverer($discoverer);

        $this->assertEquals($discoverer, $omlex->getDiscoverer());
    }

    /**
     * Get the Omlex component.
     *
     * @param array $test The test component to fetch
     *
     * @return AbstractComponent Instance of Component
     */
    protected function getComponent(array $test): AbstractComponent
    {
        $omlex = new OEmbed($test['url'], $test['api']);

        return $omlex->getComponent();
    }
}
