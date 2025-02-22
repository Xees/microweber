<?php

namespace MicroweberPackages\LiveEdit\tests;

use Illuminate\Support\Facades\Auth;
use MicroweberPackages\Core\tests\TestCase;
use MicroweberPackages\User\Models\User;

class LiveEditTopRightMenuTest extends TestCase
{


    public function testLiveEditTopRightMenu()
    {

        $user = User::where('is_admin', '=', '1')->first();
        Auth::login($user);

        $get = $this->get(route('api.live-edit.get-top-right-menu'));
        $items = ($get->getData());

        $topItem = $items[0];
        $lastItem = end($items);

        $this->assertEquals($topItem->title, 'Back to Admin');
        $this->assertEquals($topItem->href, admin_url());
        $this->assertNotEmpty($topItem->icon_html);

        $this->assertEquals($lastItem->title, 'Log out');
        $this->assertEquals($lastItem->href, logout_url());
        $this->assertNotEmpty($lastItem->icon_html);



    }
}

