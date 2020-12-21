<?php
namespace Tests\Browser\Admin\Components\Menu;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component;
use Symfony\Component\Yaml\Yaml;

class BPMenu extends Component
{

    /**
     * @var object
     */
    protected $menu;

    /**
     * @var string
     */
    protected $role;

    /**
     * AdminMenu constructor.
     */
    public function __construct($role)
    {
        $this->menu = $this->getMenu();
    }

    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return $this->menu->selector;
    }

    /**
     * Assert that the browser page contains the component.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array
     */
    public function elements()
    {
        return [];
    }

    /**
     * Select the given date.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  int  $month
     * @param  int  $day
     * @return void
     */
    public function checkMenu(Browser $browser)
    {
        foreach($this->menu->items as $i => $item) {
            if ($item->type == 'separator') {
                $this->checkSeparator($browser, $item, $i + 1);
            }
            elseif ($item->type == 'link') {
                $this->checkLink($browser, $item, $i + 1);
            }
        }
    }

    /**
     * Check menu type 'separator'
     *
     * @param Browser $browser
     * @param object $item
     */
    protected function checkSeparator(Browser $browser, object $item, int $i) : void
    {
        // evalute parameters
        eval("\$sep = \"". $item->selector ."\";");

        // assert
        $browser->assertSeeIn($sep, $item->text);
    }

    /**
     * Check menu type 'link'
     *
     * @param Browser $browser
     * @param object $item
     */
    protected function checkLink(Browser $browser, object $item, int $i) : void
    {
        // evalute parameters
        eval("\$sep = \"". $item->selector .' '.$item->link->selector ."\";");
        eval("\$url = ". $item->link->url .";");
        eval("\$text = \"". $item->link->text ."\";");

        // assert
        if (in_array($this->role, $item->roles)) {
            $browser
                ->assertSeeLink($text)
                ->click($sep)
                ->assertUrlIs($url);
        }
        else {
            $browser
                ->assertSeeLink($text)
                ->click($sep)
                ->assertUrlIs($url);
        }
    }

    /**
     * Get menu settings from yaml file
     *
     * @see menu.yml
     * @return mixed
     */
    protected function getMenu() : object
    {
        return Yaml::parseFile(__DIR__.'/menu.yml', Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
