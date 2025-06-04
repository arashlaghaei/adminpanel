<?php

namespace Modules\Core\Libraries\Traits;

use Illuminate\Support\Facades\DB;

trait TrackableJob
{
    protected function setProgress(int $progress): void
    {
        if ($this->job) {
            DB::table('jobs')->where('id', $this->job->getJobId())->update(['progress' => $progress]);
        }
    }

    protected function incrementProgress(int $increment = 1): void
    {
        if ($this->job) {
            $progress = DB::table('jobs')->where('id', $this->job->getJobId())->value('progress');
            DB::table('jobs')->where('id', $this->job->getJobId())->update(['progress' => $progress + $increment]);
        }
    }

    protected function getProgress(): int
    {
        if ($this->job) {
            return DB::table('jobs')->where('id', $this->job->getJobId())->value('progress');
        }

        return 0;
    }
}
