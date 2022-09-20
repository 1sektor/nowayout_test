<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository extends BaseRepository
{
    protected function model(): string
    {
        return Blog::class;
    }

    public function getAll($limit = null)  {
        $query = $this->model->newQuery();

        if (!empty($limit)) {
            $query->limit($limit);
        }

        return $query->whereNull('deleted_at')->get();
    }

    public function delete(Blog $blog): bool|null
    {
        return $blog->delete();
    }
}
