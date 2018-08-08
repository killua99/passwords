<?php

namespace App\Http\Controllers\Settings;

use App\Type;
use App\Contracts\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Type\CreateRequest;
use App\Http\Requests\Settings\Type\UpdateRequest;
use App\Http\Requests\Settings\Type\SearchRequest;

class TypeController extends Controller
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
        $this->content = $content;
        $this->content->model = Type::class;
    }

    /**
     * Show paginated types.
     *
     * @return JSON
     */
    public function index()
    {
        return $this->content->index();
    }

    /**
     * Create new type.
     *
     * @param  \App\Http\Requests\Settings\Type\CreateRequest $request
     * @return JSON
     */
    public function store(CreateRequest $request)
    {
        return $this->content->store($request);
    }

    /**
     * Show an type.
     *
     * @param  \App\Type $type
     * @return JSON
     */
    public function show(Type $type)
    {
        return $this->content->show($type);
    }

    /**
     * Show single type for edit.
     *
     * @param  \App\Type $type
     * @return JSON
     */
    public function edit(Type $type)
    {
        return $this->content->edit($type);
    }

    /**
     * Update an type.
     *
     * @param  \App\Http\Requests\Settings\Type\UpdateRequest $request
     * @param  \App\Type $type
     * @return JSON
     */
    public function update(UpdateRequest $request, Type $type)
    {
        return $this->content->update($request, $type);
    }

    /**
     * Destroy/delete an type.
     *
     * @param  \App\Type $type
     * @return JSON
     */
    public function destroy(Type $type)
    {
        return $this->content->destroy($type);
    }

    /**
     * Search types with name.
     *
     * @param  Request $request
     * @return JSON
     */
    public function search(SearchRequest $request)
    {
        return $this->content->search($request);
    }
}
