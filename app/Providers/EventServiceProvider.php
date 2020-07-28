<?php namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


use Unisharp\Laravelfilemanager\Events\ImageIsDeleting;
use Unisharp\Laravelfilemanager\Events\ImageIsRenaming;
use Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
use App\Listeners\DeleteImageListener;
use App\Listeners\RenameImageListener;
use App\Listeners\IsUploadingImageListener;
use App\Listeners\HasUploadedImageListener;

use Unisharp\Laravelfilemanager\Events\ImageWasDeleted;
use App\Listeners\WasDeletedImageListener;

use Unisharp\Laravelfilemanager\Events\FolderWasRenamed;
use App\Listeners\WasRenamedFolderListener;

use Unisharp\Laravelfilemanager\Events\FolderWasCreated;
// use App\Events\FolderWasCreated;
use App\Listeners\WasCreatedFolderListener;

// use App\Events\ImageWasUploaded;
// use App\Listeners\HasUploadedImageListener;

use Unisharp\Laravelfilemanager\Events\FolderWasDeleted;
// use App\Events\FolderWasDeleted;
use App\Listeners\WasDeletedFolderListener;

use Unisharp\Laravelfilemanager\Events\ImageWasRenamed;
// use App\Events\ImageWasRenamed;
use App\Listeners\WasRenamedImageListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        // ImageIsDeleting::class => [
        //     DeleteImageListener::class
        // ],
        ImageIsRenaming::class => [
            RenameImageListener::class
        ],
        ImageIsUploading::class => [
            IsUploadingImageListener::class
        ],
        ImageWasUploaded::class => [
            HasUploadedImageListener::class
        ],
        ImageWasDeleted::class => [
            WasDeletedImageListener::class
        ],
        FolderWasRenamed::class => [
            WasRenamedFolderListener::class
        ],
        FolderWasCreated::class => [
            WasCreatedFolderListener::class
        ],
        FolderWasDeleted::class => [
            WasDeletedFolderListener::class
        ],
        ImageWasRenamed::class => [
            WasRenamedImageListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
