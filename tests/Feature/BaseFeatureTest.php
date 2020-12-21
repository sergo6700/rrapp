<?php

namespace Tests\Feature;

use App\Models\Acl\User;
use App\Models\Address\Address;
use App\Models\Division\Division;
use App\Models\Event\Event;
use App\Models\File\Picture;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

/**
 * Class BaseFeatureTest
 * @package Tests\Feature
 */
abstract class BaseFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Admin's email
     *
     * @var string ADMIN_EMAIL
     */
    protected const ADMIN_EMAIL = 'admin@root.com';

    /**
     * Example user email
     *
     * @var string EXAMPLE_USER_EMAIL
     */
    protected const EXAMPLE_USER_EMAIL = 'test-test@test.ru';

    /**
     * Example user password
     *
     * @var string EXAMPLE_USER_PASSWORD
     */
    protected const EXAMPLE_USER_PASSWORD = '123456789';


    /**
     * Example picture path
     *
     * @var string EXAMPLE_PICTURE_PATH
     */
    const EXAMPLE_PICTURE_PATH = 'public/img/pictures/footer-logo-1.png';


    /**
     * Example user data for registration
     *
     * @var array $user_data_registration
     */
    protected $user_data_registration = [
        'name' => 'User',
        'email' => self::EXAMPLE_USER_EMAIL,
        'phone' => '(908)1234567',
        'tin' => '3664069397',
        'company_name' => 'ООО "Пример"',
        'role_in_company_id' => 2,
    ];

    /**
     * Data of Divisions
     *
     * @var array $division_data
     */
    protected $division_data = [
        'name' => 'Подразделение',
        'content' => 'Контент'
    ];

    /**
     * Data of Event
     *
     * @var array $event_data
     */
    protected $event_data = [
        'title' => 'Event_test',
        'visitors_count' => 10,
        'short_content' => 'Краткое описание',
        'full_content' => 'Полное описание',
    ];

    /**
     * Data of Address
     *
     * @var array $address_data
     */
    protected $address_data = [
        'title' =>  'Россия, Ростов-на-Дону, Большая Садовая улица, 39Б',
        'latitude' => '47.21997289921137',
        'longitude' => '39.70656244566341'
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $division = Division::create($this->division_data);
        $this->assertDatabaseHas((new Division())->getTable(), $this->division_data);

        $address = Address::create($this->address_data);
        $this->assertDatabaseHas((new Address())->getTable(), $this->address_data);

        $event_data = array_merge($this->event_data, [
            'date_from' => Carbon::now()->addDay()->format('Y-m-d H:i:s'),
            'division_id' => $division->getKey(),
            'address_id' => $address->getKey(),
        ]);

        Event::create($event_data);
        $this->assertDatabaseHas((new Event())->getTable(), $event_data);
    }

    /**
     * Set Authenticated User
     *
     * @return void
     */
    public function setAuthenticatedUser(): void
    {
        $data = array_merge($this->user_data_registration,
            ['password' => bcrypt(self::EXAMPLE_USER_PASSWORD)]
        );

        User::create($data);

        $this->assertDatabaseHas((new User())->getTable(), $data);
    }


    /**
     * Get model Admin user
     *
     * @return User
     */
    public function getAdminUser() :User
    {
        return User::where('email', self::ADMIN_EMAIL)->first();
    }

    /**
     * Create picture
     *
     * @return Picture
     */
    public function createPicture()
    {
        $user = $this->getAdminUser();

        $attributes = getimagesize(self::EXAMPLE_PICTURE_PATH);
        $data = [
            'uuid' => (string)Str::uuid(),
            'path' => self::EXAMPLE_PICTURE_PATH,
            'url' => asset(self::EXAMPLE_PICTURE_PATH),
            'mimetype' => $attributes['mime'],
            'filename' => basename(self::EXAMPLE_PICTURE_PATH),
            'original_name' => basename(self::EXAMPLE_PICTURE_PATH),
            'size' => filesize(self::EXAMPLE_PICTURE_PATH),
        ];

        $picture = Picture::create($data);
        $picture->user_id = $user->id;
        $picture->save();

        $this->assertDatabaseHas((new Picture())->getTable(), $data);

        return $picture;
    }
}
