<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class ProfilePageTest extends DuskTestCase
{
    private $pageUrl;

    function __construct()
    {
        $this->pageUrl = '/user/profile';
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $exampleTest = new ExampleTest();
            $exampleTest->testBasicLogin();

            $browser->visit(new Pages\ProfilePage())
                ->assertSeeIn('section.content-header', 'My profile');
        });
    }

    /**
     * Test basic form for Display name is working with a name.
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdateName()
    {
        $this->browse(function ($browser) {
            $name = 'Amitav Roy';
            $browser->visit(new Pages\ProfilePage())
                ->type('name', $name)
                ->click('.btn-success')
                ->assertPathIs($this->pageUrl)
                ->assertSee('Profile saved')
                ->assertInputValue('name', $name);
        });
    }

    /**
     * Checking that the blank display field will return a valid error message.
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBlankNameNotAllowed()
    {
        $this->browse(function ($browser) {
            $browser->visit(new Pages\ProfilePage())
                ->type('name', '')
                ->click('.btn-success')
                ->assertPathIs($this->pageUrl)
                ->assertSee('You need to mention your name.');
        });
    }
    
//    public function testProfileImageUpload()
//    {
//        $this->browse(function ($browser) {
//            $imagePath = public_path('adminlte/avtar.png');
//            $browser->visit(new Pages\ProfilePage())
//                ->click('#profile-pic-block .btn.btn-primary.btn-sm')
//                ->assertSee('Upload an Image')
//                ->attach('image-upload', $imagePath)
//                ->click('#uploadFileCall')
//                ->waitUntilMissing('.Image-upload .Modal')
//                ->visit($this->pageUrl);
//        });
//    }
}
