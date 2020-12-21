<?php


namespace Tests\Feature\Admin\Media;

use App\Models\File\Picture;
use App\Models\Media\Media;
use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class AbstractMediaTest
 * @package Tests\Feature\Admin\Media
 */
abstract class AbstractMediaTest extends AdminLoginTest
{
    /**
     * Example page data
     *
     * @var array $page_data
     */
    protected $media_data = [
        'description' => 'О проекте',
        'image' => 'storage/test.jpg',
        'link' => 'https://mbrostov.ru',
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        $picture = Picture::createFromElfinder(
            $this->media_data['image']
        );

        unset($this->media_data['image']);

        $media_data = array_merge($this->media_data, [
            'picture_id' => $picture->id
        ]);

        Media::create($media_data);

        $this->assertDatabaseHas((new Media())->getTable(), $media_data);
    }
}
