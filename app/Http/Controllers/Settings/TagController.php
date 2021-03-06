<?php

namespace App\Http\Controllers\Settings;

use App\Tag;
use App\Contracts\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Tag\IndexRequest;
use App\Http\Requests\Settings\Tag\CreateRequest;
use App\Http\Requests\Settings\Tag\UpdateRequest;
use App\Http\Requests\Settings\Tag\SearchRequest;

use App\Http\Resources\TagCollection;
use App\Http\Resources\Tag as TagResource;

class TagController extends Controller
{
    /**
     * Content Service Provider
     *
     * @var \App\Contracts\Content
     */
    private $content;

    /**
     * Constructor of the class.
     *
     * @param \App\Contracts\Content $content
     */
    public function __construct(Content $content)
    {
        $this->authorizeResource(Tag::class);
        $this->content = $content;
        $this->content->model = Tag::query();
    }

    /**
     * Show paginated tags.
     *
     * @param  IndexRequest $request
     * @return JSON
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('browse', Tag::class);
        return new TagCollection($this->content->index($request));
    }

    /**
     * Create new tag.
     *
     * @param  \App\Http\Requests\Settings\Tag\CreateRequest $request
     * @return JSON
     */
    public function store(CreateRequest $request)
    {
        return new TagResource($this->content->store($request));
    }

    /**
     * Show an tag.
     *
     * @param  \App\Tag $tag
     * @return JSON
     */
    public function show(Tag $tag)
    {
        return new TagResource($this->content->show($tag));
    }

    /**
     * Show single tag for edit.
     *
     * @param  \App\Tag $tag
     * @return JSON
     */
    public function edit(Tag $tag)
    {
        return new TagResource($this->content->edit($tag));
    }

    /**
     * Update an tag.
     *
     * @param  \App\Http\Requests\Settings\Tag\UpdateRequest $request
     * @param  \App\Tag $tag
     * @return JSON
     */
    public function update(UpdateRequest $request, Tag $tag)
    {
        return $this->content->update($request, $tag);
    }

    /**
     * Destroy/delete an tag.
     *
     * @param  \App\Tag $tag
     * @return JSON
     */
    public function destroy(Tag $tag)
    {
        return $this->content->destroy($tag);
    }

    /**
     * Search tags with name.
     *
     * @param  Request $request
     * @return JSON
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('browse', Tag::class);
        return new TagCollection($this->content->search($request));
    }
}
