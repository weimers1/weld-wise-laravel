<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

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

    static function header()
    {
        $pages = [
            'home',
            'faq',
        ];

        if (Auth::check()) {
            array_push($pages, 'tests');
        }

        return Page::whereIn(DB::raw('LOWER(title)'), $pages)->get();
    }

    static function tiles()
    {
        $pages = [
            'home',
            'faq',
            'tests',
        ];

        if (Auth::check()) {
            array_push($pages, 'profile');
        }

        return Page::whereIn(DB::raw('LOWER(title)'), $pages)->get();
    }

    static function footer()
    {
        $pages = [
            'home',
            'faq',
            'tests',
        ];

        return Page::whereIn(DB::raw('LOWER(title)'), $pages)->get();
    }
}
