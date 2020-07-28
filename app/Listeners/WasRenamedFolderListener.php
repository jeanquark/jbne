<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\FolderWasRenamed;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;
use App\Folder;
use App\File;

class WasRenamedFolderListener
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
    public function handle(FolderWasRenamed $event)
    {
        // Get the old path to the folder
        $oldFolderPath = str_replace(public_path(), "", $event->oldPath());

        // Get the new path to the folder
        $newFolderPath = str_replace(public_path(), "", $event->newPath());

        // Get the folder name
        $newFolderName = basename($event->newPath());

        // Get old folder
        $oldFolder = Folder::where('path', '=', $oldFolderPath)->firstOrFail();

        // Update folder in database
        $oldFolder->update(['path' => $newFolderPath, 'name' => $newFolderName]);

        // Get old folder ID
        $oldFolderId = $oldFolder->id;

        // Update all files that are located in the old folder path
        $files = File::where('parent_folder_id', '=', $oldFolderId)->get();

        if (!$files->isEmpty()) {
            foreach ($files as $file) {
                $fileName = $file->name;
                $file->update(['path' => $newFolderPath . DIRECTORY_SEPARATOR . $fileName]);
            }
        }
    }
}
