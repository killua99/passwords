<?php

namespace App\Http\Controllers\Settings;

use App\Group;
use App\Contracts\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Group\CreateRequest;
use App\Http\Requests\Settings\Group\UpdateRequest;
use App\Http\Requests\Settings\Group\SearchRequest;

class GroupController extends Controller
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
        $this->content->model = Group::class;
    }

    /**
     * Show paginated groups.
     *
     * @return JSON
     */
    public function index()
    {
        return $this->content->index();
    }

    /**
     * Create new group.
     *
     * @param  \App\Http\Requests\Settings\Group\CreateRequest $request
     * @return JSON
     */
    public function store(CreateRequest $request)
    {
        return $this->content->store($request);
    }

    /**
     * Show an group.
     *
     * @param  \App\Group $group
     * @return JSON
     */
    public function show(Group $group)
    {
        return $this->content->show($group);
    }

    /**
     * Show single group for edit.
     *
     * @param  \App\Group $group
     * @return JSON
     */
    public function edit(Group $group)
    {
        return $this->content->edit($group);
    }

    /**
     * Update an group.
     *
     * @param  \App\Http\Requests\Settings\Group\UpdateRequest $request
     * @param  \App\Group $group
     * @return JSON
     */
    public function update(UpdateRequest $request, Group $group)
    {
        return $this->content->update($request, $group);
    }

    /**
     * Destroy/delete an group.
     *
     * @param  \App\Group $group
     * @return JSON
     */
    public function destroy(Group $group)
    {
        return $this->content->destroy($group);
    }

    /**
     * Search groups with name.
     *
     * @param  Request $request
     * @return JSON
     */
    public function search(SearchRequest $request)
    {
        return $this->content->search($request);
    }
}
