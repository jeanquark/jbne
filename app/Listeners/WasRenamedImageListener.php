<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\ImageWasRenamed;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;
use App\File;

class WasRenamedImageListener
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
    public function handle(ImageWasRenamed $event)
    {
        // dd('Folder was renamed!');

        // Get the old path to the file
        // $oldFilePath = str_replace(public_path(), "", $event->oldPath());
        $oldFilePath = str_replace(public_path(), "", dirname($event->oldPath()));

        // Get the new path to the file
        $newFilePath = str_replace(public_path(), "", dirname($event->newPath()));

        // Get the file name
        $newFileName = basename($event->newPath());

        // Update file in database
        File::where('path', '=', $oldFilePath)->update(['name' => $newFileName]);
    }
}
