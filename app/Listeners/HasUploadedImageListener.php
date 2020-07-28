<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
// use App\Events\ImageWasUploaded;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;
use App\File;
use App\Folder;
use Session;

class HasUploadedImageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // dd('def');
    }

    /**
     * Handle the event.
     *
     * @param  ImageWasUploaded  $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        // Get the path to the file
        // $filePath = str_replace(public_path(), "", dirname($event->path()));
        $filePath = str_replace(public_path(), "", $event->path());

        // Get the name of the file
        $fileName = basename($event->path());

        // Get the parent folder path
        $parentFolderPath = dirname(str_replace(public_path(), "", $event->path()));

        // Find the parent folder id
        $parentFolder = Folder::where('path', '=', $parentFolderPath)->get();
        if (!$parentFolder->isEmpty()) {
            $parentFolderId = $parentFolder[0]->id;
        } else {
            $parentFolderId = 0;
        }

        // Get authenticated user id
        // $user_id = Auth::id();
        $member_id = Auth::guard('member')->user()->id;
        // dd($member_id);

        // Save file in database
        // File::create(['creator_id' => $user_id, 'path' => $filePath, 'name' => $fileName, 'parent_folder_id' => $parentFolderId]);
        File::create(['creator_id' => $member_id, 'path' => $filePath, 'name' => $fileName, 'parent_folder_id' => $parentFolderId]);
    }
}
