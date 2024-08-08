<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-image-paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update image paths in database to remove "storage/" prefix for S3';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating image paths in the database...');

        // Fetch all records that need updating
        $images = DB::table('product_images')->where('path', 'like', 'storage/images/%')->get();

        foreach ($images as $image) {
            $newPath = str_replace('storage/', '', $image->path);

            // Update the record
            DB::table('product_images')
                ->where('id', $image->id)
                ->update(['path' => $newPath]);

            $this->info("Updated path for image ID {$image->id} from {$image->path} to {$newPath}");
        }

        $this->info('All image paths have been updated successfully.');
    }
}
