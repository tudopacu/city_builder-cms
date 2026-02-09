<?php

class NewsManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openNewsIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/news/manage/index');
        $I->see('News', 'h1');
    }

    public function openNewsCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/news/manage/create');
        $I->see('Create News', 'h1');
    }

    public function createNewsWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/news/manage/create');
        $I->submitForm('form', [
            'News[title]' => '',
            'News[content]' => '',
            'News[image_url]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Title cannot be blank');
        $I->see('Content cannot be blank');
        $I->see('Image Url cannot be blank');
    }

    public function createNewsSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/news/manage/create');
        $I->submitForm('form', [
            'News[title]' => 'Test News',
            'News[content]' => 'This is test news content',
            'News[image_url]' => '/images/news.png',
        ]);
        $I->expectTo('see news created');
        $I->see('Test News');
    }
}
