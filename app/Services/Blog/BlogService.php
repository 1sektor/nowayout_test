<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{

    public function __construct(protected BlogRepository $blogRepository)
    {
    }

    public function store(array $data): Blog|null
    {
        /** @var Blog $blog */
        $blog = $this->blogRepository->create($data);

        return $blog;
    }

    public function update(Blog $blog, array $data): Blog
    {
        $blog->update($data);

        /** @var Blog $blog */
        $blog = $this->blogRepository->find($blog->id);

        return $blog;
    }

    public function all(): Collection|null
    {
        return $this->blogRepository->getAll();
    }

    public function delete(Blog $blog): bool
    {
        return $this->blogRepository->delete($blog);
    }
}
