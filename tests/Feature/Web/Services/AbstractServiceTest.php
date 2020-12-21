<?php

namespace Tests\Feature\Web\Services;

use App\Models\Division\Division;
use App\Models\Email\Email;
use App\Models\Service\Service;
use App\Models\Tag\Tag;
use Tests\Feature\BaseFeatureTest;

/**
 * Class AbstractServiceTest
 * @package Tests\Feature\Web\Services
 */
abstract class AbstractServiceTest extends BaseFeatureTest
{
    /**
     * Example user email
     *
     * @var array $service_data
     */
    protected $service_data = [
        'title' => 'Service_test',
        'short_content' => 'Краткое описание',
        'full_content' => 'Полное описание',
    ];

    /**
     * Tag name
     *
     * @var string TAG_NAME
     */
    public const TAG_NAME = 'tag';

    /**
     * Example email for service
     *
     * @var string EMAIL_FOR_SERVICE
     */
    public const EMAIL_FOR_SERVICE = 'test-service@gmail.com';

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        $division = Division::where($this->division_data)->first();

        $service_data = array_merge($this->service_data, [
            'division_id' => $division->getKey()
        ]);

        $service = Service::create($service_data);

        $tag = new Tag(['name' => self::TAG_NAME]);
        $service->tags()->save($tag);

        $email = new Email(['email' => self::EMAIL_FOR_SERVICE]);
        $service->emails()->save($email);
    }
}
