<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\Blog\BlogService;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogController extends ApiController
{
    public function __construct(protected BlogService $blogService)
    {
    }

    public function index(): JsonResource
    {
        $blogs = $this->blogService->all();

        return BlogResource::collection($blogs);
    }

    public function store(BlogStoreRequest $request): JsonResource
    {
        $data = $request->validated();

        $blog = $this->blogService->store($data);

        return BlogResource::make($blog);
    }

    public function update(Blog $blog, BlogStoreRequest $request): JsonResource
    {
        $data = $request->validated();

        $blog = $this->blogService->update($blog, $data);

        return BlogResource::make($blog);
    }

    public function destroy(Blog $blog): JsonResource
    {
        return JsonResource::make(['success' => $this->blogService->delete($blog)]);
    }
}
