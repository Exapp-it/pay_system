<?php

namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FileUploadService
{

    protected string $filename;

    public function __construct(
        protected UploadedFile $file,
        protected string       $dirname,
    )
    {
    }

    /**
     * @return void
     */
    public function upload(): void
    {
        $this->filename = time() . '_' . $this->file->getClientOriginalName();
        $this->file->storeAs("public/{$this->dirname}", $this->filename);
    }

    public function getFileName(): string
    {
        return $this->dirname . '/' . $this->filename;
    }

}



