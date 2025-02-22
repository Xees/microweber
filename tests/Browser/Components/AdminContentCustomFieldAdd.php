<?php

namespace Tests\Browser\Components;

use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class AdminContentCustomFieldAdd extends BaseComponent
{
    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return '#mw-admin-container';
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

    public function addCustomField(Browser $browser, $key, $value) {

       // $browser->script("$('html, body').animate({ scrollTop: $('.js-custom-fields-card-tab').offset().top -80 }, 0);");
        $browser->script("document.querySelector('.js-custom-fields-card-tab').scrollIntoView({block: 'center', inline: 'nearest',behavior :'auto'});");
        $browser->pause(1000);

        if(!$browser->driver->findElement(WebDriverBy::cssSelector('#custom-fields-settings'))->isDisplayed()) {
             $browser->script("document.querySelector('.js-custom-fields-card-tab').scrollIntoView({block: 'center', inline: 'nearest',behavior :'auto'});");


            $browser->click('.js-custom-fields-card-tab');

            $browser->pause(3000);
        }

        // add custom field price
        $browser->waitForText('Add new field');
        $browser->script("document.querySelector('.js-add-custom-field').scrollIntoView({block: 'center', inline: 'nearest',behavior :'auto'});");
        $browser->pause(300);

        $browser->click('.js-add-custom-field');
        $browser->pause(3000);
//        $browser->waitForText('Fields');

        $browser->pause(1000);

         $cfKey = '.js-add-custom-field-'.$key;
        $browser->script("document.querySelector('button".$cfKey."').click()");
        $browser->pause(2000);

        $browser->script("document.querySelector('.mw-modal-header .btn-close').click()");

        //        $browser->whenAvailable($cfKey, function ($b) use ($cfKey) { // Wait
//            $b->script("document.querySelector('".$cfKey."').scrollIntoView({block: 'center', inline: 'nearest',behavior :'auto'});");
//            $b->pause(300);
//
//            $b->click($cfKey);
//        });

     //   $browser->waitFor($cfKey,100);


        $browser->waitForText($value);

    }
}
