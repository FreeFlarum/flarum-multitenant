<?php

/*
 * This file is part of fof/amazon-affiliation.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\AmazonAffiliation\Tests;

use FoF\AmazonAffiliation\AmazonLinkManipulator;
use Laminas\Diactoros\Uri;
use PHPUnit\Framework\TestCase;

class AmazonLinkManipulatorTest extends TestCase
{
    protected function createManipulator()
    {
        $manipulator = new AmazonLinkManipulator();

        $manipulator->affiliateTags = [
            'com' => 'abcdef',
        ];

        return $manipulator;
    }

    public function test_add_tag()
    {
        $manipulator = $this->createManipulator();

        $uri = $manipulator->process(new Uri('https://www.amazon.com/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.com/dp/B00004TZY8?tag=abcdef', (string) $uri);
    }

    public function test_add_tag_with_other_domains_and_proto()
    {
        $manipulator = $this->createManipulator();

        $expected = 'https://www.amazon.com/dp/B00004TZY8?tag=abcdef';

        $uri = $manipulator->process(new Uri('http://www.amazon.com/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals($expected, (string) $uri);

        $uri = $manipulator->process(new Uri('http://amazon.com/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals($expected, (string) $uri);

        $uri = $manipulator->process(new Uri('https://amazon.com/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals($expected, (string) $uri);

        $uri = $manipulator->process(new Uri('https://www.amazon.co.uk/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.co.uk/dp/B00004TZY8', (string) $uri);
    }

    public function test_add_tag_with_other_query_params()
    {
        $manipulator = $this->createManipulator();

        $uri = $manipulator->process(new Uri('https://www.amazon.com/Mattel-Games-UNO-Card-Game/dp/B00004TZY8?pd_rd_wg=WJpCt&pd_rd_r=670b61ea-72f1-4d11-aa5e-1d7f2f580948&pd_rd_w=wf5ho&ref_=pd_gw_ri&pf_rd_r=TW615HC2HPGYTBD7T649&pf_rd_p=c116cecb-5676-58e0-b306-0894a1d0149e'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.com/Mattel-Games-UNO-Card-Game/dp/B00004TZY8?pd_rd_wg=WJpCt&pd_rd_r=670b61ea-72f1-4d11-aa5e-1d7f2f580948&pd_rd_w=wf5ho&ref_=pd_gw_ri&pf_rd_r=TW615HC2HPGYTBD7T649&pf_rd_p=c116cecb-5676-58e0-b306-0894a1d0149e&tag=abcdef', (string) $uri);
    }

    public function test_replace_existing_tag()
    {
        $manipulator = $this->createManipulator();

        $uri = $manipulator->process(new Uri('https://www.amazon.com/dp/B00004TZY8?tag=other'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.com/dp/B00004TZY8?tag=abcdef', (string) $uri);
    }

    public function test_keep_existing_tag()
    {
        $manipulator = $this->createManipulator();

        $manipulator->keepExistingTag = true;

        $uri = $manipulator->process(new Uri('https://www.amazon.com/dp/B00004TZY8?tag=other'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.com/dp/B00004TZY8?tag=other', (string) $uri);
    }

    public function test_unhandled_doesnt_get_tag()
    {
        $manipulator = $this->createManipulator();

        $uri = $manipulator->process(new Uri('https://www.amazon.fr/dp/B00004TZY8'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.fr/dp/B00004TZY8', (string) $uri);
    }

    public function test_unhandled_tag_kept()
    {
        $manipulator = $this->createManipulator();

        $uri = $manipulator->process(new Uri('https://www.amazon.fr/dp/B00004TZY8?tag=other'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.fr/dp/B00004TZY8?tag=other', (string) $uri);
    }

    public function test_unhandled_tag_removed()
    {
        $manipulator = $this->createManipulator();

        $manipulator->removeTagIfUnhandled = true;

        $uri = $manipulator->process(new Uri('https://www.amazon.fr/dp/B00004TZY8?tag=other'));

        $this->assertNotNull($uri);
        $this->assertEquals('https://www.amazon.fr/dp/B00004TZY8', (string) $uri);
    }

    public function test_does_not_touch_non_amazon_urls()
    {
        $manipulator = $this->createManipulator();

        $this->assertNull($manipulator->process(new Uri('https://example.com/test')));
        $this->assertNull($manipulator->process(new Uri('https://www.example.fr/test')));
        $this->assertNull($manipulator->process(new Uri('https://amazon.example.com/test')));
    }
}
