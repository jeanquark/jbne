<?php namespace App\Listeners;

use Unisharp\Laravelfilemanager\Events\FolderWasDeleted;
// use App\Events\FolderWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Folder;

class WasDeletedFolderListener
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
     * @param  ImageIsDeleting  $event
     * @return void
     */
    public function handle(FolderWasDeleted $event)
    {
        $folderPath = str_replace(public_path(), "", $event->path());

        // Delete folder in database
        Folder::where('path', $folderPath)->delete();
    }
}
