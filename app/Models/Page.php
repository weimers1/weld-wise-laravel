<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    public $attributes = [
        'title' => '',
        'icon' => 'bi-question-square',
        'link' => '/',
    ];

    protected $fillable = ['title', 'icon', 'link'];

    static function header()
    {
        $pages = [
            new Page([
                'title' => 'Home',
                'icon' => 'bi-house',
                'link' => '/',
            ]),
            new Page([
                'title' => 'FAQ',
                'icon' => 'bi-question-circle',
                'link' => '/faq',
            ]),
        ];

        if (Auth::check()) {
            array_push($pages, new Page([
                'title' => 'Tests',
                'icon' => 'bi-file-text',
                'link' => '/test',
            ]));
        }

        return $pages;
    }

    static function tiles()
    {
        $pages = [
            new Page([
                'title' => 'Tests',
                'icon' => 'bi-file-text',
                'link' => '/test',
            ]),
            new Page([
                'title' => 'FAQ',
                'icon' => 'bi-question-circle',
                'link' => '/faq',
            ]),
        ];

        if (Auth::check()) {
            array_push($pages, new Page([
                'title' => 'Profile',
                'icon' => 'bi-person',
                'link' => '/user/settings',
            ]));
        }

        return $pages;
    }

    static function footer()
    {
        $pages = [
            new Page([
                'title' => 'Home',
                'icon' => 'bi-house',
                'link' => '/',
            ]),
            new Page([
                'title' => 'FAQ',
                'icon' => 'bi-question-circle',
                'link' => '/faq',
            ]),
            new Page([
                'title' => 'Tests',
                'icon' => 'bi-file-text',
                'link' => '/test',
            ]),
        ];

        if (Auth::check()) {
            array_push($pages, new Page([
                'title' => 'Profile',
                'icon' => 'bi-person',
                'link' => '/user/settings',
            ]));
        } else {
            array_push($pages, new Page([
                'title' => 'Log In',
                'icon' => 'bi-box-arrow-in-right',
                'link' => '/user/login',
            ]));
        }

        return $pages;
    }
}
