<?php

namespace App\Http\Controllers;

use App\Mentors;
use App\Content;
use App\Enrollments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Api extends Controller
{
    private function defaults($group)
    {
        $array = [
            'faqs' => '<dt>Question</dt><dd>Answer</dd>'
        ];

        return $array[$group];
    }

    public function create(Request $request)
    {
        $group = $request->input('group');

        $count = Content::where('group', $group)->orderby('key', 'desc')->first()->key;
        $count = str_replace($group.'_', '', $count);
        $count = (int)$count + 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);

        $key = $group.'_'.$count;
        $content = $this->defaults($group);

        $item = new Content;

        $item->key = $key;
        $item->content = $content;
        $item->group = $group;

        $item->save();

        return response()->json(['status' => 'success', 'item' => $item]);
    }
}
