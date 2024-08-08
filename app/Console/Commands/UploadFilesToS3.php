<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UploadFilesToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-files-to-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload local files to AWS S3';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $localPath = storage_path('app/public/images');

        $files = Storage::disk('public')->allFiles('images');

        foreach ($files as $file) {
            $localFilePath = $localPath . '/' . $file;
            $s3FilePath = '/' . $file;

            $fileContents = Storage::disk('public')->get($file);

            Storage::disk('s3')->put($s3FilePath, $fileContents);

            $this->info("Uploaded: {$file} to S3 as {$s3FilePath}");
        }

        $this->info('All files have been uploaded to S3 successfully.');
    }
}
