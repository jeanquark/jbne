<?php namespace App\Listeners;

// use App\Events\FolderWasCreated;
use Unisharp\Laravelfilemanager\Events\FolderWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;
use App\Folder;

class WasCreatedFolderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageIsUploading  $event
     * @return void
     */
    public function handle(FolderWasCreated $event)
    {
        // Get the path to the folder
        $folderPath = str_replace(public_path(), "", $event->path());

        // Get the folder name
        $folderName = basename($event->path());

        // Get the parent folder path
        $parentFolderPath = dirname(str_replace(public_path(), "", $event->path()));

        // Find the parent folder id
        $parentFolder = Folder::where('path', '=', $parentFolderPath)->get();
        if (!$parentFolder->isEmpty()) {
            $parentFolderId = $parentFolder[0]->id;
        } else {
            $parentFolderId = 0;
        }

        // Save folder in database
        Folder::create(['path' => $folderPath, 'name' => $folderName, 'parent_folder_id' => $parentFolderId]);
    }
}
