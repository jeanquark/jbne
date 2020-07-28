<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageIsDeleting;
use Unisharp\Laravelfilemanager\Events\ImageIsDeleting;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\File;

class DeleteImageListener
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
    public function handle(ImageIsDeleting $event)
    {
        // Get the public path for the file
        $publicFilePath = str_replace(public_path(), "", $event->path());

        // Search for usages of the file
        $used = File::where('path', $publicFilePath)->get();
        
        if (count($used) > 0) {
            // The image is in use, create a response message
            $message = $this->formatMessage($used);
            // Die with response message
            die($message);
        }
    }

    private function formatMessage($files)
    {
        $message = "<p>The file you are trying to delete is in use in the file_paths table with the following id's:</p>";
        $message .= "<ul>";
        foreach ($files as $file) {
            $message .= "<li>$file->id</li>";
        }
        $message .= "</ul>";
        $message .= "<p>Please remove those database references before you can delete the file.</p>";
        return $message;
    }
}
