<?php

namespace App\View\Components\Post;

use Illuminate\View\Component;

class Block extends Component
{
    public $page;
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, $post)
    {
        $this->page = $page;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post.block');
    }
}
